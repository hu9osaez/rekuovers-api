<?php namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Events\UserSignedUp;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\SignUpRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class AuthController extends BaseController
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function login(LoginRequest $request) {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];

        throw_unless($issuedToken = auth()->attempt($credentials), AuthorizationException::class);

        event(new UserLoggedIn(auth()->id()));

        $mToken = new Token();
        $mToken->token = $issuedToken;

        return responder()->success($mToken)->toArray();
    }

    public function signUp(SignUpRequest $request) {
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;

        throw_unless($user->save(), \Illuminate\Auth\AuthenticationException::class);

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
