<?php namespace App\Transformers;

use App\Models\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    public function transform(Song $song)
    {
        $formattedSong = [
            'id' => (int) $song->id,
            'original_song_id' => $song->original_song_id,
            'original_song_title' => $song->originalSong->title,
            'publisher_id' => $song->publisher->id,
            'publisher_name' => $song->publisher->name,
            'type' => $song->type,
            'youtube_id' => $song->youtube_id,
            'likes_count' => $song->likes->count(),
            'created_at' => $song->created_at->toDateTimeString()
        ];

        return $formattedSong;
    }
}