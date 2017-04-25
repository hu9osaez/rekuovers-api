<?php namespace App\Transformers;


use App\OriginalSong;
use League\Fractal\TransformerAbstract;

class OriginalSongTransformer extends TransformerAbstract
{
    public function transform(OriginalSong $originalSong)
    {
        return $originalSong->attributesToArray();
    }
}