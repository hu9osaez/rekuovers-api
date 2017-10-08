<?php

namespace App\Transformers;

use App\Models\Authentication;
use Flugg\Responder\Transformers\Transformer;

class AuthenticationTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\Authentication $authentication
     * @return array
     */
    public function transform(Authentication $authentication)
    {
        return [
            'token' => $authentication->getToken(),
            'refresh_token' => $authentication->getRefreshToken()
        ];
    }
}
