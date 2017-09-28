<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Artist as ArtistResource;
use App\Models\Artist;
use App\Transformers\ArtistTransformer;
use App\Transformers\SongTransformer;

/**
 * Artist resource representation.
 *
 * @Resource("Artists", uri="/artists")
 */
class ArtistController extends BaseController {

    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function index() {
        $artists = $this->artist->paginate();

        return ArtistResource::collection($artists);
    }

    /**
     * @param $uuid
     * @return ArtistResource
     */
    public function show($uuid) {
        $artist = $this->artist->byUuid($uuid);

        if(!$artist) {
            abort(404);
        }

        return new ArtistResource($artist);
    }

    public function showSongs($id) {
        $artist = $this->artist->find($id);

        if(!$artist) {
            $this->response->errorNotFound();
        }

        return $this->response->paginator($artist->songs()->paginate(), new SongTransformer());
    }
}