<?php namespace App\Transformers;

use App\Models\Artist;
use League\Fractal\TransformerAbstract;

class ArtistTransformer extends TransformerAbstract
{
    public function transform(Artist $artist)
    {
        $formattedArtist = [
            'id' => (int) $artist->id,
            'name' => $artist->name
        ];

        return $formattedArtist;
    }
}