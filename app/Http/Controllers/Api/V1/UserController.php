<?php namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Transformers\UserTransformer;

class UserController extends BaseController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($username) {
        $user = $this->user->where('username', $username)->first();

        if(!$user) {
            $this->response->errorNotFound();
        }

        return $this->response->item($user, new UserTransformer());
    }
}
