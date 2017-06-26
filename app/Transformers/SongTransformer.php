<?php namespace App\Transformers;

use App\Models\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    public function transform(Song $song)
    {
        $originalSong = $song->originalSong;
        $artist = $song->originalSong->artist;

        $formattedSong = [
            'id' => (int) $song->id,
            'original_song_id' => $song->original_song_id,
            'original_song_title' => $originalSong->title,
            'artist_id' => $artist->id,
            'artist_name' => $artist->name,
            'type' => $song->type,
            'youtube_id' => $song->youtube_id,
            'likes_count' => $song->likes->count(),
            'created_at' => $song->created_at->toDateTimeString()
        ];

        return $formattedSong;
    }
}