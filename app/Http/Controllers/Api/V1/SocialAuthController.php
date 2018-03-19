<?php namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Http\Requests\Api\V1\FacebookAuthRequest;
use App\Models\Token;
use App\Services\FacebookAccountService;
use Socialite;

class SocialAuthController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function facebook(FacebookAuthRequest $request, FacebookAccountService $service) {
        $facebookUser = Socialite::driver('facebook')->userFromToken($request->access_token);

        $user = $service->getOrCreateUser($facebookUser);

        event(new UserLoggedIn($user));

        throw_unless($issuedToken = \JWTAuth::fromUser($user), \Illuminate\Auth\AuthenticationException::class);

        $mToken = new Token(['token' => $issuedToken]);

        return responder()->success($mToken)->respond();
    }
}
