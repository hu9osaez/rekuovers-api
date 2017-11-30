<?php

namespace App\Transformers;

use App\Models\Artist;
use Flugg\Responder\Transformers\Transformer;

class ArtistTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\Artist $artist
     * @return array
     */
    public function transform(Artist $artist)
    {
        return [
            'id'    => $artist->uuid,
            'name'  => $artist->name,
            'slug'  => $artist->slug,
        ];
    }
}
