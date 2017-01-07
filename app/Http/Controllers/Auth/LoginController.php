<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Revision;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin_users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validation = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if($this->validation->fails()){
            return $this->validation->errors()->toJson();
        }else{
            $user = User::where('email',$request->get('email'))->first();

            if($user === null){
                return ['email'=>trans('app.Email not found')];
            }else{
                if(!\Hash::check($request->get('password'),$user->password))
                    return ['password'=>trans('app.Incorrect password')];
            }

// If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                $request->session()->regenerate();

                $this->clearLoginAttempts($request);

                Revision::create([
                    'revisionable_type' => User::class,
                    'revisionable_id'   => \Auth::user()->id,
                    'admin_user_id'   => \Auth::user()->id,
                    'action'   => 'login',
                    'at'                => (new \DateTime())->getTimestamp(),
                    'by'                => \Auth::user()->name . ' '. \Auth::user()->lastname,
                    'state'             => serialize(\Auth::user()),
                ]);

                return $this->authenticated($request, $this->guard()->user())
                    ?: ['redirect'=>$this->redirectPath()];
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        }

    }


    public function logout(Request $request)
    {
        \Auth::logout();

        return redirect(route('login'));
    }
}
