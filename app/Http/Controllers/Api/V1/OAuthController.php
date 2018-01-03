<?php namespace App\Http\Controllers\Api\V1;

use App\Events\UserLoggedIn;
use App\Events\UserSignedUp;
use App\Models\Authentication;
use App\Models\User;
use Socialite;

class OAuthController extends BaseController
{
    public function facebook() {
        $validator = validator(request()->all(), ['access_token' => 'required']);

        if ($validator->fails()) {
            return responder()
                ->error()
                ->data($validator->errors()->toArray())
                ->respond(401);
        }

        $facebookUser = Socialite::driver('facebook')->userFromToken(request('access_token'));

        // Si <facebook_id> existe, retornar el usuario encontrado
        if($user = User::where('facebook_id', $facebookUser->id)->first()) {
            event(new UserLoggedIn($user->id));

            $user->refresh();

            $authentication = new Authentication($user->api_token);

            return responder()->success($authentication)->respond();
        }
        else {
            // Si <email> NO existe ===> crear usuario, asociar datos y devolver <api_token>
            if(!User::where('email', $facebookUser->email)->first())
            {
                $newUser = new User();

                $newUser->name = $facebookUser->name;
                $newUser->username = str_slug($facebookUser->name);
                $newUser->email = $facebookUser->email;
                $newUser->facebook_id = $facebookUser->id;

                $newUser->save();

                event(new UserSignedUp($newUser->id));
                event(new UserLoggedIn($newUser->id));

                $newUser->refresh();

                $authentication = new Authentication($newUser->api_token);

                return responder()->success($authentication)->respond();
            }
            // Usuario(email) existe y NO tiene facebook_id ===> asociar datos y devolver token
            elseif($user = User::where('email', $facebookUser->email)->whereNull('facebook_id')->first())
            {
                $user->facebook_id = $facebookUser->id;
                $user->save();

                event(new UserLoggedIn($user->id));

                $user->refresh();

                $authentication = new Authentication($user->api_token);

                return responder()->success($authentication)->respond();
            }
            // Usuario(email) existe y SI tiene facebook_id ===> devolver token
            else
            {
                $user = User::where('email', $facebookUser->email)
                    ->where('facebook_id', $facebookUser->id)
                    ->first();

                event(new UserLoggedIn($user->id));

                $user->refresh();

                $authentication = new Authentication($user->api_token);

                return responder()->success($authentication)->respond();
            }
        }
    }
}
