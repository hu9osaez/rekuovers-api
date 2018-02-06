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
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        throw_unless($issuedToken = auth()->attempt($credentials), AuthorizationException::class);

        /** @noinspection PhpParamsInspection */
        event(new UserLoggedIn(auth()->user()));

        $mToken = new Token(['token' => $issuedToken]);

        return responder()->success($mToken)->respond();
    }

    /**
     * @param SignUpRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function signUp(SignUpRequest $request) {
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;

        throw_unless($user->save(), \Illuminate\Auth\AuthenticationException::class);
        throw_unless($issuedToken = \JWTAuth::fromUser($user), \Illuminate\Auth\AuthenticationException::class);

        event(new UserSignedUp($user));
        event(new UserLoggedIn($user));

        $mToken = new Token(['token' => $issuedToken]);

        return responder()->success($mToken)->respond();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        $token = request()->attributes->get('x-token');

        $mToken = new Token(['token' => $token]);

        return responder()->success($mToken)->respond();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return responder()->success(auth()->user())->respond();
    }
}
