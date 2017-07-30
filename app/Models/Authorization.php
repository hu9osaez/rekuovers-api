<?php namespace App\Models;

class Authorization
{
    protected $token;

    public function __construct($token = null)
    {
        $this->token = $token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function toArray()
    {
        return [
            'id' => hash('md5', $this->token),
            'token' => $this->token
        ];
    }
}