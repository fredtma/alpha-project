<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Email;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
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

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    protected $redirectPath = '/dashboard';
    protected $loginPath = '/login';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'firstname' => 'required|max:255',
                    'lastname' => 'required|max:255',
                    'email' => 'required|email|confirmed|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $user = User::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password'])
        ]);
        $slug = md5($data['firstname'] . $data['lastname'] . $data['email'] . time());
        $user->slug = $user->id . $slug;
        $user->save();

        $json = array();
        $json['recipient'] = $data['firstname'] . ' ' . $data['lastname'];
        $json['slug'] = $user->slug;

        $email = new Email();
        $email->recipient = $data['firstname'] . ' ' . $data['lastname'];
        $email->email = $data['email'];
        $email->template = 'activation';
        $email->json = json_encode($json);
        $email->save();

        return $user;
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $this->getCredentials($request);

        if (Auth::validate($credentials)) {
            $user = Auth::getLastAttempted();
            if ($user->active) {
                Auth::login($user, $request->has('remember'));
                return redirect()->intended($this->redirectPath());
            } else {
                return redirect($this->loginPath())
                                ->withInput($request->only('email', 'remember'))
                                ->withErrors([
                                    'active' => 'inactive'
                ]);
            }
        }

        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());
        return redirect('login')->with('success','You have successfully registered. Please check your email for further instructions.');
    }    
}
