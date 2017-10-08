<?php namespace App\Models;

use App\Transformers\AuthenticationTransformer;
use Flugg\Responder\Contracts\Transformable;

class Authentication implements Transformable
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * Authentication constructor.
     * @param array $tokens
     */
    public function __construct($tokens = [])
    {
        $this->token = $tokens['api_token'];
        $this->refreshToken = $tokens['refresh_token'];
    }

    public function getToken() {
        return $this->token;
    }

    public function getRefreshToken() {
        return $this->refreshToken;
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
