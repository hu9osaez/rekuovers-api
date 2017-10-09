<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'       => $user->uuid,
            'name'     => $user->name,
            'username' => $user->username,
            'likes'    => $user->likes->count(),
            'covers'   => $user->covers->count()
        ];
    }
}
