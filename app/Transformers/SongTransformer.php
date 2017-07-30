<?php namespace App\Transformers;

use App\Models\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    public function transform(Song $song)
    {
        $originalSong = $song->originalSong;

        $formattedSong = [
            'id' => (int) $song->id,
            'original_song_id' => $song->original_song_id,
            'original_song_title' => $originalSong->title,
            'type' => $song->type,
            'youtube_id' => $song->youtube_id,
            'likes_count' => $song->likes->count(),
            'created_at' => $song->created_at->toDateTimeString()
        ];

        return $formattedSong;
    }
}