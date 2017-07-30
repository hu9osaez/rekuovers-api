<?php namespace App\Http\Controllers\Api\v1;

use App\Models\Authorization;
use App\Models\User;
use App\Transformers\AuthorizationTransformer;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    private $loginRules = [
        'login' => 'required',
        'password' => 'required'
    ];

    private $signupRules = [
        'name' => 'required',
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ];

    public function login(Request $request) {
        $validator = app('validator')->make($request->only('login', 'password'), $this->loginRules);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($loginField, '=', $request->input('login'))->first();

        if(!$user || !app('hash')->check($request->password, $user->password)) {
            return $this->response->errorUnauthorized();
        }

        $token = $user->generateToken();

        $authorization = new Authorization($token);

        return $this->response->item($authorization, new AuthorizationTransformer())->statusCode(201);
    }

    public function signup(Request $request) {
        $credentials = $request->only('name', 'username', 'email', 'password');

        $validator = app('validator')->make($credentials, $this->signupRules);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $user = User::create([
            'name' => $credentials['name'],
            'username' => $credentials['username'],
            'email' => $credentials['email'],
            'password' => app('hash')->make($credentials['password'])
        ]);

        if(!$user) {
            return $this->response->errorUnauthorized();
        }

        $token = $user->generateToken();

        $authorization = new Authorization($token);

        return $this->response->item($authorization, new AuthorizationTransformer())->statusCode(201);
    }

    public function showMe() {
        return $this->response->array(app('auth')->user()->toArray());
    }
}