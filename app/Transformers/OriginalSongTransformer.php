<?php namespace App\Transformers;

use App\Models\OriginalSong;
use League\Fractal\TransformerAbstract;

class OriginalSongTransformer extends TransformerAbstract
{
    public function transform(OriginalSong $originalSong)
    {
        $formattedOriginalSong = [
            'id' => (int) $originalSong->id,
            'title' => $originalSong->title,
            'artists' => $originalSong->artists
        ];

        return $formattedOriginalSong;
    }
}