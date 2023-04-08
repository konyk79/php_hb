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



//    public function login(Request $request)
//    {
//
//
//       $this->validateLogin($request);
////        $request->session()->set('timezone',$request->timezone);
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }
//
//        if ($this->attemptLogin($request)) {
//            return $this->sendLoginResponse($request);
//        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        $this->incrementLoginAttempts($request);
//
//        return $this->sendFailedLoginResponse($request);
//    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

//        if($user = Socialite::driver('facebook')->user()){
//
//        }else{
//            return 'something went wrong';
//        }
        try {
            $user = Socialite::driver('facebook')->fields([
                'first_name', 'last_name', 'email', 'locale' //'gender'
            ])->scopes(['first_name', 'last_name', 'locale'])->user();
        } catch (Exception $e) {
            return dd('OAUTH error'.$e);//redirect()->route('user.index');
        }
//        dd($user);
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
            //redirect on email confirmation page when offer to confirm email
            // return view('frontend.auth.email_confirmation.email_confirmation',compact('user_id','user_email'));
            return redirect(url('/unconfirmed-email'));
        }
//        dd($request->timezone);
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
