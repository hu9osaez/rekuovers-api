<?php

namespace App\Transformers;

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
        return [
            'id'          => $cover->uuid,
            'title'       => $cover->song->title,
            'type'        => $cover->type,
            'youtube_id'  => $cover->youtube_id,
            'description' => $cover->description,
            'likes'       => $cover->likes->count(),
            'created_at'  => $cover->created_at->toDateTimeString()
        ];
    }
}
