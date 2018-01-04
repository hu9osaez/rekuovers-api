<?php namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Events\UserSignedUp;
use App\Http\Requests\Api\V1\FacebookAuthRequest;
use App\Models\Token;
use App\Models\User;
use Socialite;

class SocialAuthController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function facebook(FacebookAuthRequest $request) {
        $facebookUser = Socialite::driver('facebook')->userFromToken($request->access_token);

        // Si <facebook_id> existe, retornar el usuario encontrado
        if(!$user = User::where('facebook_id', $facebookUser->id)->first()) {
            // Si <email> NO existe ===> crear usuario, asociar datos y devolver token
            if(!User::where('email', $facebookUser->email)->first())
            {
                $user = new User();

                $user->name = $facebookUser->name;
                $user->username = str_slug($facebookUser->name);
                $user->email = $facebookUser->email;
                $user->facebook_id = $facebookUser->id;

                if($user->save()) {
                    event(new UserSignedUp($user));
                }
                else {
                    throw new \Illuminate\Auth\AuthenticationException;
                }
            }
            // Usuario(email) existe y NO tiene facebook_id ===> asociar datos y devolver token
            elseif($user = User::where('email', $facebookUser->email)->whereNull('facebook_id')->first())
            {
                $user->facebook_id = $facebookUser->id;
                $user->save();
            }
        }

        event(new UserLoggedIn($user));

        throw_unless($issuedToken = \JWTAuth::fromUser($user), \Illuminate\Auth\AuthenticationException::class);

        $mToken = new Token(['token' => $issuedToken]);

        return responder()->success($mToken)->respond();
    }
}
