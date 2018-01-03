<?php namespace App\Models;

use App\Transformers\TokenTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Support\Fluent;

/**
 * Class Token
 * @package App\Models
 * @property string $token
 */
class Token extends Fluent implements Transformable
{
    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|string|callable
     */
    public function transformer()
    {
        return TokenTransformer::class;
    }
}
