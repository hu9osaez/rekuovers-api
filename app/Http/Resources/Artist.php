<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Artist extends Resource
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
            'id' => $this->uuid,
            'name' => $this->name
        ];
    }
}
