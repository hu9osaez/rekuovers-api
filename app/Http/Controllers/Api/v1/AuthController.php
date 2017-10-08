<?php namespace App\Http\Controllers\Api\v1;

use App\Events\UserSignedIn;
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

        $tokens = auth('jwt')->attempt($credentials);

        if(!$tokens) {
            return responder()->error()->respond(401);
        }

        $decodedToken = app('jwt-manager')->decode($tokens['api_token']);
        $userId = $decodedToken->user_id;

        event(new UserSignedIn($userId));

        $authentication = new Authentication($tokens);

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

        $tokens = auth('jwt')->attempt($request->only(['username', 'password']));

        //event(new UserSignedUp($user->id));
        event(new UserSignedIn($user->id));

        $authentication = new Authentication($tokens);

        return responder()->success($authentication)->respond();
    }

    public function refreshToken() {
        if (($errors = auth('jwt')->validateToken('refresh_token')) === true) {
            $tokens = auth('jwt')->refreshToken();

            $authentication = new Authentication($tokens);

            return responder()->success($authentication)->respond();
        }
        else {
            return responder()->error($errors['code'], $errors['message'])->respond(401);
        }
    }

    public function showMe() {
        $user = auth('jwt')->user();
        return $this->response->item($user, new UserTransformer());
    }
}
