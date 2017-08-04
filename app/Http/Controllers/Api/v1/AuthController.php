<?php namespace App\Http\Controllers\Api\v1;

use App\Events\UserLoggedIn;
use App\Http\Traits\AuthResponse;
use App\Models\User;
use App\Transformers\UserTransformer;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request; // @TODO: Change Request to Request from Dingo
use Socialite;

class AuthController extends BaseController
{
    use AuthResponse;

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

    public function login(Request $request) {
        $validator = app('validator')->make($request->all(), $this->loginRules);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($loginField, '=', $request->login)->first();

        if(!$user || !app('hash')->check($request->password, $user->password)) {
            $this->response->errorUnauthorized();
        }

        event(new UserLoggedIn($user->id));

        return $this->token($user->generateToken());
    }

    public function signup(Request $request) {
        $validator = app('validator')->make($request->all(), $this->signupRules);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if(!$user) {
            $this->response->errorUnauthorized();
        }

        event(new UserLoggedIn($user->id));

        return $this->token($user->generateToken());
    }

    public function authorizeFacebook(Request $request) {
        $validator = app('validator')->make($request->all(), ['access_token' => 'required']);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        $facebookUser = Socialite::driver('facebook')->userFromToken($request->access_token);

        // Si <facebook_id> existe, retornar el usuario encontrado
        if($user = User::where('facebook_id', $facebookUser->id)->first()) {
            event(new UserLoggedIn($user->id));

            return $this->token($user->generateToken());
        }
        else {
            // Si <email> NO existe ===> crear usuario, asociar datos y devolver <api_token>
            if(!User::where('email', $facebookUser->email)->first())
            {
                $newUser = User::create([
                    'name' => $facebookUser->name,
                    'username' => str_slug($facebookUser->name),
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id
                ]);

                event(new UserLoggedIn($newUser->id));

                return $this->token($newUser->generateToken());
            }
            // Usuario(email) existe y NO tiene facebook_id ===> asociar datos y devolver token
            elseif($user = User::where('email', $facebookUser->email)->whereNull('facebook_id')->first())
            {
                $user->facebook_id = $facebookUser->id;
                $user->save();

                event(new UserLoggedIn($user->id));

                return $this->token($user->generateToken());
            }
            // Usuario(email) existe y SI tiene facebook_id ===> devolver token
            else
            {
                $user = User::where('email', $facebookUser->email)->where('facebook_id', $facebookUser->id)->first();

                event(new UserLoggedIn($user->id));

                return $this->token($user->generateToken());
            }
        }
    }

    public function showMe() {
        return $this->response->item(app('auth')->user(), new UserTransformer());
    }
}