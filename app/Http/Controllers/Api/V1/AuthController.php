<?php namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Events\UserSignedUp;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\SignUpRequest;
use App\Models\Authentication;
use App\Models\User;

class AuthController extends BaseController
{

    public function login(LoginRequest $request) {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];

        if(!auth()->attempt($credentials)) {
            return responder()->error()->respond(401);
        }

        event(new UserLoggedIn(auth()->id()));

        auth()->user()->refresh();

        $authentication = new Authentication(auth()->user()->api_token);

        return responder()->success($authentication)->respond();
    }

    public function signUp(SignUpRequest $request) {
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;

        if(!$user->save()) {
            return responder()->error()->respond(401);
        }

        event(new UserSignedUp($user->id));
        event(new UserLoggedIn($user->id));

        $user->refresh();

        $authentication = new Authentication($user->api_token);

        return responder()->success($authentication)->respond();
    }

    public function me() {
        return responder()->success(auth()->user())->respond();
    }
}
