<?php

namespace App\Http\Controllers\Auth;

use App\Form;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Snowfire\Beautymail\Beautymail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'country_id' => 'numeric',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $form = Form::where('name', 'register_form')->first();
        $dataUser = array('email_confirmation_code' => self::generateEmailConfirmationCode());
        $dataUser['created_at'] = Carbon::now();
        $dataUser['updated_at'] = Carbon::now();
        foreach ($form->fields as $field) {
            if (($field->type !== 'none') && array_key_exists($field->name, $data)) {
                if ($field->element == 'password')
                    $dataUser[$field->name] = bcrypt($data[$field->name]);
                else
                    $dataUser[$field->name] = $data[$field->name];
            }

        }
        DB::table('users')->insert($dataUser);
        $user = User::where('email', $dataUser['email'])->first();
        GroupHasUsers::create([
            'group_id' => $user->type_id,
            'user_id' => $user->id
        ]);
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.beautymail_firstpassword', ['password' => $data['password'], 'user' => $user], function ($message) use ($user) {
            $message
                ->from('no-reply@harmoniousbreathing.com')
                ->to($user->email)
                ->subject(__('emails.beautymail_firstpassword_subject'));
        });
        $this->guard()->logout();
        return $user;

    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(url('/registered'));
    }

    public function confirmEmail($confirmation_code)
    {
        if (!$confirmation_code || $confirmation_code === null) {
            flash(trans('auth.email_confirm_no_code'))->error()->important();
            return redirect(route('login'));
        }

        $user = User::where('email_confirmation_code', '=', $confirmation_code)->first();

        if ($user === null) {
            flash(trans('auth.email_confirm_wrong_code'))->error()->important();
            return redirect(route('login'));
        }

        $user->email_confirmed = true;
        $user->email_confirmation_code = null;
        $user->save();

        flash(trans('auth.email_confirmed'))->success()->important();

        return redirect(route('login'));
    }

    public static function generateEmailConfirmationCode()
    {
        return str_random(30);
    }

    public static function sendEmailConfirmationCode($registration)
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.beautymail_email_confirmation', ['registration' => $registration], function ($message) use ($registration) {
            $message
                ->from('no-reply@harmoniousbreathing.com')
                ->to($registration->email)
                ->subject(__('emails.beautymail_email_confirmation_subject'));
        });
//        }
        return back();
    }


//    public static function newUserCreation(Request $request, $passwordGenerationRequired, $profile): User
//    {
//
//      //  return $user;
//    }
}
