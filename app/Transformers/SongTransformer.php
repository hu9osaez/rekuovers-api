<?php namespace App\Transformers;

use App\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['original_song'];

    public function transform(Song $song)
    {
        return $song->attributesToArray();
    }

    public function includeOriginalSong(Song $song)
    {
        return $this->item($song->originalSong()->first(), new OriginalSongTransformer());
    }
}