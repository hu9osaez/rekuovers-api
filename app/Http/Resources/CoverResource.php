<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CoverResource extends Resource
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
            'title' => $this->song->title,
            'type' => $this->type,
            'youtube_id' => $this->youtube_id,
            'description' => $this->description,
            'likes' => $this->likes->count(),
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}





