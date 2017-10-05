<?php namespace App\Models;

class Authorization
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
     * Authorization constructor.
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