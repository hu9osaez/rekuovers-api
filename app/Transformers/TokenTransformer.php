<?php namespace App\Transformers;

use App\Models\Token;
use Flugg\Responder\Transformers\Transformer;

class TokenTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\Token $model
     * @return array
     */
    public function transform(Token $model)
    {
        return [
            'token_type' => 'bearer',
            'access_token' => $model->token,
            'expires_in' => config('jwt.ttl')*60,
            'refresh_to' => now()->addMinutes(config('jwt.refresh_ttl'))->timestamp
        ];
    }
}
