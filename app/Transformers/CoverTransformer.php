<?php namespace App\Transformers;

use App\Models\Cover;
use League\Fractal\TransformerAbstract;

class CoverTransformer extends TransformerAbstract
{
    public function transform(Cover $cover)
    {
        $formattedCover = [
            'id' => (int) $cover->id,
            'song_id' => $cover->song_id,
            'song_title' => $cover->song->title,
            'publisher_id' => $cover->publisher->id,
            'publisher_name' => $cover->publisher->name,
            'type' => $cover->type,
            'youtube_id' => $cover->youtube_id,
            'likes_count' => $cover->likes->count(),
            'created_at' => $cover->created_at->toDateTimeString()
        ];

        return $formattedCover;
    }
}