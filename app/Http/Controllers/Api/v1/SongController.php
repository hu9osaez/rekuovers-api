<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\SongResource;
use App\Models\Song;
use App\Transformers\ArtistTransformer;
use App\Transformers\SongTransformer;

/**
 * Song resource representation.
 *
 * @Resource("Songs", uri="/songs")
 */
class SongController extends BaseController
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function index() {
        $songs = $this->song->paginate();

        return SongResource::collection($songs);
    }

    public function show($uuid) {
        $song = $this->song->byUuid($uuid);

        if(!$song) {
            abort(404);
        }

        return new SongResource($song);
    }
}
