<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use Auth;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $page = Page::getByName('login');
        if (is_null($page)) return '404 //Todo';
        return View::make('app')->with(['page' => $page]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        try {
            $user = Socialite::driver('facebook')->fields([
                'first_name', 'last_name', 'email', 'locale' //'gender'
            ])->scopes(['first_name', 'last_name', 'locale'])->user();
        } catch (Exception $e) {
            return dd('OAUTH error'.$e);//redirect()->route('user.index');
        }
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);
        // $user->token;
    }

    protected function authenticated(Request $request, $user)
    {
        //  email_confirmation-----{  Don't allow login if unconfirmed email
        if (!$user->email_confirmed){
            $user_id=$user->id;
            $user_email=$user->email;
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect(url('/unconfirmed-email'));
        }
            Session::put('timezone',$request->timezone);
            Session::put('timezone_offset',$request->timezone_offset);
        // email_confirmation-----}
    }
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('email', $facebookUser->email)->first();

        if ($authUser) {
            return $authUser;
        }
        return User::create([
//            'fb_id' => $facebookUser->id,
            'name' => $facebookUser->user['first_name'],
            'last_name' => $facebookUser->user['last_name'],
            'country_id' => 1 ,
            'phone' => '+3000000000000',
            'password'=>'111',
//            'avatar' => $facebookUser->avatar,
            'email' => $facebookUser->email,
//            'gender' => $facebookUser->user['gender'],
        ]);

    }
}
