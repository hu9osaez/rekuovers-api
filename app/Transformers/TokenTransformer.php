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
        ];
    }
}
