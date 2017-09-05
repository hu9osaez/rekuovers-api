<?php namespace App\Transformers;

use App\Models\Song;
use League\Fractal\TransformerAbstract;

class SongTransformer extends TransformerAbstract
{
    public function transform(Song $originalSong)
    {
        $artistsIds = $originalSong->artists;

        $formattedOriginalSong = [
            'id' => (int) $originalSong->id,
            'title' => $originalSong->title,
            'artists' => $artistsIds->pluck('id')
        ];

        return $formattedOriginalSong;
    }
}