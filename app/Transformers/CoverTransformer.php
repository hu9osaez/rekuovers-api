<?php namespace App\Transformers;

use App\Models\Cover;
use Flugg\Responder\Transformers\Transformer;

class CoverTransformer extends Transformer
{
    /**
     * Transform the model.
     *
     * @param  \App\Models\Cover $cover
     * @return array
     */
    public function transform(Cover $cover)
    {
        $artists = $cover->song->artists()
            ->get(['slug', 'name'])
            ->pluck('name', 'slug')
            ->toArray();

        return [
            'id'          => $cover->uuid,
            'title'       => $cover->song->title,
            'artists'     => $artists,
            'youtube_id'  => $cover->youtube_id,
            'description' => $cover->description,
            'likes'       => $cover->likes->count(),
            'created_at'  => $cover->created_at->toDateTimeString()
        ];
    }
}
