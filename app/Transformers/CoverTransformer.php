<?php namespace App\Transformers;

use App\Models\Cover;
use League\Fractal\TransformerAbstract;

class CoverTransformer extends TransformerAbstract
{
    public function transform(Cover $song)
    {
        $formattedCover = [
            'id' => (int) $song->id,
            'song_id' => $song->song_id,
            'song_title' => $song->song->title,
            'publisher_id' => $song->publisher->id,
            'publisher_name' => $song->publisher->name,
            'type' => $song->type,
            'youtube_id' => $song->youtube_id,
            'likes_count' => $song->likes->count(),
            'created_at' => $song->created_at->toDateTimeString()
        ];

        return $formattedCover;
    }
}