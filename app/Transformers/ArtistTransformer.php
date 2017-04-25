<?php namespace App\Transformers;

use App\Artist;
use League\Fractal\TransformerAbstract;

class ArtistTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['original_songs'];

    public function transform(Artist $artist)
    {
        return $artist->attributesToArray();
    }

    public function includeOriginalSongs(Artist $artist)
    {
        return $this->collection($artist->originalSongs()->get(), new OriginalSongTransformer());
    }
}