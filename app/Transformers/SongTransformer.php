<?php namespace App\Transformers;

use App\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['original_song'];

    public function transform(Song $song)
    {
        $formattedSong = [
            'id' => (int) $song->id,
            'original_song_id' => $song->original_song_id,
            'type' => $song->type,
            'youtube_id' => $song->youtube_id,
            'likes_count' => $song->likes->count(),
            'created_at' => $song->created_at->toDateTimeString(),
            'updated_at' => $song->updated_at->toDateTimeString()
        ];
        return $formattedSong;
    }

    public function includeOriginalSong(Song $song)
    {
        return $this->item($song->originalSong, new OriginalSongTransformer());
    }
}