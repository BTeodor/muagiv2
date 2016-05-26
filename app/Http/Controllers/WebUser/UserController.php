<?php

namespace App\Http\Controllers\WebUser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Auth;
use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Events\User\Registered;
use Validator;
use App;
use App\Support\Enum\UserStatus;

class UserController extends Controller
{
	public function getLogin(){
		if (Auth::check()) {
			return redirect()->intended('/dashboard');
		}
		return view('webuser.login');
	}

	public function postLogin(LoginRequest $request){

		$credentials = $this->getCredentials($request);

		$user = Auth::getProvider()->retrieveByCredentials($credentials);
		if ($user == NULL) {
			return redirect()->back()->withErrors('Incorrect login credentials');
		}
		Auth::login($user);

		event(new LoggedIn($user));

		return redirect()->intended('/dashboard');
	}

	public function getRegister(){
		if (Auth::check()) {
			return redirect()->intended('/dashboard');
		}
		return view('webuser.register');
	}

	public function postRegister(RegisterRequest $request){
		if(Auth::check()) return redirect()->intended('/dashboard');
		$status = settings('reg_email_confirmation')
		? UserStatus::UNCONFIRMED
		: UserStatus::ACTIVE;

		$data = [
			'username' => $request->username,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'status' => $status
		];
		$user = new App\User($data);
		$user->save();

		$user->role()->attach(App\Role::findByName('User'));
		
		Auth::login($user);
		event(new LoggedIn($user));

		return redirect()->intended('/dashboard');
	}

	/**
	 * Validate if provided parameter is valid email.
	 *
	 * @param $param
	 * @return bool
	 */
	private function isEmail($param) {
		return !Validator::make(
			['username' => $param],
			['username' => 'email']
		)->fails();
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername() {
		return 'username';
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  Request  $request
	 * @return array
	 */
	protected function getCredentials(Request $request) {
		// The form field for providing username or password
		// have name of "username", however, in order to support
		// logging users in with both (username and email)
		// we have to check if user has entered one or another
		$usernameOrEmail = $request->get($this->loginUsername());

		if ($this->isEmail($usernameOrEmail)) {
			return [
				'email' => $usernameOrEmail,
				'password' => $request->get('password'),
			];
		}

		return $request->only($this->loginUsername(), 'password');
	}
}
