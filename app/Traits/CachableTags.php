<?php namespace App\Traits;

use App\Models\Cover;

trait CachableTags
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Cviebrock\EloquentTaggable\Models\Tag[]
     */
    protected function getTagsByCoverId($id)
    {
        return cache()->remember('tags.cover.id.'.$id, config('rekuovers.expire_cache_song'), function () use ($id) {
            return Cover::findOrFail($id)->tags;
        });
    }
}
