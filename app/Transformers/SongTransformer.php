<?php namespace App\Transformers;

use App\Models\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    public function transform(Song $song)
    {
        $artistsIds = $song->artists;

        $formattedSong = [
            'id' => (int) $song->id,
            'title' => $song->title,
            'artists' => $artistsIds->pluck('id')
        ];

        return $formattedSong;
    }
}