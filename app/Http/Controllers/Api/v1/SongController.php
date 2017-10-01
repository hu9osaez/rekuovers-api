<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\SongResource;
use App\Models\Song;

class SongController extends BaseController
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function search() {
        $q = request()->input('q');

        $results = $this->song
            ->where('title', 'like', "%{$q}%")
            ->orWhere('slug', 'like', "%{$q}%")
            ->get();

        return SongResource::collection($results);
    }

    public function show($uuid) {
        $song = $this->song->byUuid($uuid);

        if(!$song) {
            abort(404);
        }

        return new SongResource($song);
    }
}
