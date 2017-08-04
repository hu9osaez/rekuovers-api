<?php namespace App\Models;

use Carbon\Carbon;

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

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => hash('md5', $this->token),
            'token' => $this->token,
            'generated_at' => Carbon::now()->toDateTimeString()
        ];
    }
}