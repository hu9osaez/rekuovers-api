<?php namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function authorize(Request $request) {
        $credentials = $request->only('email', 'password');

        if(!$token = \Auth::attempt($credentials)) {
            $this->response->errorUnauthorized();
        }

        return $this->response->array(compact('token'))->setStatusCode(201);
    }

    public function signup(Request $request) {
        $credentials = $request->only('email', 'name', 'password');

        $user = User::create([
            'email' => $credentials['email'],
            'name' => $credentials['name'],
            'password' => app('hash')->make($credentials['password'])
        ]);

        if(!$user) {
            $this->response->errorUnauthorized();
        }

        $token = \Auth::fromUser($user);

        return $this->response->array(compact('token'))->setStatusCode(201);
    }
}