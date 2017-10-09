<?php namespace App\Models;

use App\Transformers\AuthenticationTransformer;
use Flugg\Responder\Contracts\Transformable;

class Authentication implements Transformable
{
    /**
     * @var string
     */
    protected $apiToken;

    /**
     * Authentication constructor.
     * @param array $tokens
     */
    public function __construct($api_token)
    {
        $this->apiToken = $api_token;
    }

    public function getApiToken() {
        return $this->apiToken;
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|string|callable
     */
    public function transformer()
    {
        return AuthenticationTransformer::class;
    }
}
