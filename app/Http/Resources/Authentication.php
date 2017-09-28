<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Authentication extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => hash('md5', $this->getToken()),
            'token' => $this->getToken(),
            'refresh_token' => $this->getRefreshToken()
        ];
    }
}
