<?php namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $formattedUser = [
            'id' => (int) $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'published_songs' => $user->songs->count(),
            'liked_songs' => $user->likes->count(),
            'created_at' => $user->created_at->toDateTimeString()
        ];

        return $formattedUser;
    }
}
