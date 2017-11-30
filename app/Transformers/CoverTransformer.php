<?php namespace App\Transformers;

use App\Models\Cover;
use App\Traits\CachableSong;
use App\Traits\CachableTags;
use Flugg\Responder\Transformers\Transformer;

class CoverTransformer extends Transformer
{
    use CachableSong, CachableTags;

    /**
     * Transform the model.
     *
     * @param  \App\Models\Cover $cover
     * @return array
     */
    public function transform(Cover $cover)
    {
        $song = $this->getSongById($cover->song_id);

        $artists = $song->artists->map(function ($a) {
            return [
                'slug' => $a->slug,
                'name' => $a->name
            ];
        })->toArray();

        $tags = $this->getTagsByCoverId($cover->id)->map(function ($t) {
            return [
                'slug' => $t->normalized,
                'name' => $t->name
            ];
        })->toArray();

        return [
            'id'          => $cover->uuid,
            'song_title'  => $song->title,
            'youtube_id'  => $cover->youtube_id,
            'description' => $cover->description,
            'likes'       => $cover->likes->count(),
            'artists'     => $artists,
            'tags'        => $tags,
            'created_at'  => $cover->created_at->toDateTimeString()
        ];
    }
}
