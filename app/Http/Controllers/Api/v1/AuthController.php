<?php namespace App\Http\Controllers\Api\v1;

use App\Events\UserSignedIn;
use App\Events\UserSignedUp;
use App\Http\Controllers\Api\v1\Requests\SignUpRequest;
use App\Http\Controllers\Api\v1\Requests\SignInRequest;
use App\Http\Resources\AuthenticationResource;
use App\Models\Authorization;
use App\Models\User;
use Illuminate\Http\Request; // @TODO: Change Request to Request from Dingo
use Socialite;

class AuthController extends BaseController
{

    public function signIn(SignInRequest $request) {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];

        $tokens = auth('jwt')->attempt($credentials);

        if(!$tokens) {
            abort(401, 'Unauthorized');
        }

        $decodedToken = app('jwt-manager')->decode($tokens['api_token']);
        $userId = $decodedToken->user_id;

        event(new UserSignedIn($userId));

        $authorization = new Authorization($tokens);

        return new AuthenticationResource($authorization);
    }

    public function signUp(SignUpRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if(!$user) {
            abort(401, 'Unauthorized');
        }

        $tokens = auth('jwt')->attempt($request->only(['username', 'password']));

        event(new UserSignedUp($user->id));
        event(new UserSignedIn($user->id));

        $authorization = new Authorization($tokens);

        return new AuthenticationResource($authorization);
    }

    public function authorizeFacebook(Request $request) {
        $validator = app('validator')->make($request->all(), ['access_token' => 'required']);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $facebookUser = Socialite::driver('facebook')->userFromToken($request->access_token);

        // Si <facebook_id> existe, retornar el usuario encontrado
        if($user = User::where('facebook_id', $facebookUser->id)->first()) {
            event(new UserSignedIn($user->id));

            $tokens = auth('jwt')->issueToken($user);

            return $this->authWithJwt($tokens);
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
                event(new UserSignedIn($newUser->id));

                $tokens = auth('jwt')->issueToken($newUser);

                return $this->authWithJwt($tokens);
            }
            // Usuario(email) existe y NO tiene facebook_id ===> asociar datos y devolver token
            elseif($user = User::where('email', $facebookUser->email)->whereNull('facebook_id')->first())
            {
                $user->facebook_id = $facebookUser->id;
                $user->save();

                event(new UserSignedIn($user->id));

                $tokens = auth('jwt')->issueToken($user);

                return $this->authWithJwt($tokens);
            }
            // Usuario(email) existe y SI tiene facebook_id ===> devolver token
            else
            {
                $user = User::where('email', $facebookUser->email)->where('facebook_id', $facebookUser->id)->first();

                event(new UserSignedIn($user->id));

                $tokens = auth('jwt')->issueToken($user);

                return $this->authWithJwt($tokens);
            }
        }
    }

    public function refreshToken() {
        if (($errors = auth('jwt')->validateToken('refresh_token')) === true) {
            $tokens = auth('jwt')->refreshToken();

            return $this->authWithJwt($tokens);
        }
        else {
            return $this->response->error($errors['message'], $errors['code']);
        }
    }

    public function showMe() {
        $user = auth('jwt')->user();
        return $this->response->item($user, new UserTransformer());
    }
}