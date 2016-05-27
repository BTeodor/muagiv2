<?php

namespace App\Http\Controllers\Api\v2;

use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Events\User\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\MobileRegisterRequest;
use App\Mailers\UserMailer;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\Auth\TwoFactor\Contracts\Authenticatable;
use App\Support\Enum\UserStatus;
use App;
use Auth;
use Authy;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;

class MobileAuthController extends Controller
{
    private $users;

    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users) {
        $this->middleware('guest', ['except' => ['getLogout']]);
        $this->middleware('auth', ['only' => ['getLogout']]);
        $this->middleware('registration', ['only' => ['getRegister', 'postRegister']]);
        $this->users = $users;
    }
    //
    public function postLogin(Request $request){
        $credentials = $this->getCredentials($request);

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if ($user == NULL) {
            return response()->json([
                'status' => false,
                'data' => array('message' => 'Incorrect email')
            ]);
        }
        if (sha1(md5($request->password)) != $user->password) {
            return response()->json([
                'status' => false,
                'data' => array('message' => 'Incorrect password')
            ]);
        }

        Auth::login($user);
        $user->update(['last_login' => Carbon::now()]);
        event(new LoggedIn($user));
        return response()->json([
            'status' => true,
            'data' => array('user' => $user)
        ]);
    }

    public function postRegister(Request $request){

        $errors = array();
        if (count(App\User::where('email', $request->email)->get()) > 0) {
            array_push($errors, "Email already exists");
        }
        if (count(App\User::where('username', $request->username)->get()) > 0) {
            array_push($errors, "Username already exists");
        }

        if (count($errors) > 0) {
            return response()->json([
                'status' => false,
                'data' => ['errors' => $errors]
            ]);
        }

        $status = settings('reg_email_confirmation')
        ? UserStatus::UNCONFIRMED
        : UserStatus::ACTIVE;

        try {
            $user = $this->users->create(array_merge(
                $request->only('email', 'username', 'password'), // auto encrypt password by setPasswordAttribute in User model
                ['status' => $status]
            ));
        } catch (\Illuminate\Database\QueryException $e){
            return response()->json([
                'status' => false,
                'data' => [
                    'code' => $e->getCode(),
                    'message' => $e->errorInfo[2]
                ]
            ], 500);
        }
        $this->users->setRole($user->id, App\Role::findByName('User'));

        return response()->json([
            'status' => true,
            'data' => [
                'user' => $user
            ]
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername() {
        return 'email';
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
