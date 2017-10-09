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
            'id'           => md5($authentication->getApiToken()),
            'api_token'    => $authentication->getApiToken(),
            'generated_at' => now()->timestamp
        ];
    }
}
