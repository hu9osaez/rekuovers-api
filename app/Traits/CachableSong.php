<?php namespace App\Traits;

use App\Models\Song;

trait CachableSong
{
    /**
     * @param $id
     * @return Song
     */
    protected function getSongById($id)
    {
        return cache()->remember('song.id.'.$id, config('rekuovers.expire_cache_song'), function () use ($id) {
            return Song::findOrFail($id);
        });
    }
}
