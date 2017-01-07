<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\Revision;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin_users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register (){
        return redirect('/');
    }

    public function showRegistrationForm(){
        return redirect('/');
    }

    public  function login(\Illuminate\Http\Request $request){
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

            $throttles = $this->isUsingThrottlesLoginsTrait();

            if ($throttles && $this->hasTooManyLoginAttempts($request)) {
                return $this->sendLockoutResponse($request);
            }
            $credentials = $this->getCredentials($request);

            if (\Auth::attempt($credentials, $request->has('remember'))) {
                Revision::create([
                    'revisionable_type' => User::class,
                    'revisionable_id'   => \Auth::user()->id,
                    'admin_user_id'   => \Auth::user()->id,
                    'action'   => 'login',
                    'at'                => (new \DateTime())->getTimestamp(),
                    'by'                => \Auth::user()->name . ' '. \Auth::user()->lastname,
                    'state'             => serialize(\Auth::user()),
                ]);
                return array('redirect'=>'/');
            }
        }
    }
}
