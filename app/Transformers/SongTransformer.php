<?php

namespace App\Transformers;

use App\Models\Song;
use Flugg\Responder\Transformers\Transformer;

class SongTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\Song $song
     * @return array
     */
    public function transform(Song $song)
    {
        return [
            'id'     => $song->uuid,
            'title'  => $song->title,
            'covers' => (int)$song->covers->count(),
            'links' => [
                'self' => route('api.songs.show', $song->uuid)
            ]
        ];
    }
}
