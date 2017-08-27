<?php namespace App\Models;

use Carbon\Carbon;

class Authorization
{
    /**
     * @var string
     */
    protected $token;

    protected $refreshToken;

    public function __construct($tokens = null)
    {
        $this->token = $tokens['api_token'];
        $this->refreshToken = $tokens['refresh_token'];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => hash('md5', $this->token),
            'token' => $this->token,
            'refresh_token' => $this->refreshToken
        ];
    }
}