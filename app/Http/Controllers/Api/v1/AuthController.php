<?php namespace App\Http\Controllers\Api\v1;

use App\Models\User;
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

    public function authorize(Request $request) {
        $validator = app('validator')->make($request->only('login', 'password'), $this->loginRules);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([
            $loginField => $request->input('login')
        ]);

        $credentials = $request->only($loginField, 'password');

        print_r($credentials);

        if(!$token = app('auth')->attempt($credentials)) {
            $this->response->errorUnauthorized();
        }

        return $this->response->array(compact('token'))->setStatusCode(201);
    }

    public function signup(Request $request) {
        $credentials = $request->only('name', 'username', 'email', 'password');

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => app('hash')->make($credentials['password'])
        ]);

        if(!$user) {
            $this->response->errorUnauthorized();
        }

        $token = \Auth::fromUser($user);

        return $this->response->array(compact('token'))->setStatusCode(201);
    }
}