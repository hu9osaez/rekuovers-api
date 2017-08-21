<?php namespace App\Http\Controllers\Api\v1;

use App\Models\Artist;
use App\Transformers\ArtistTransformer;
use App\Transformers\OriginalSongTransformer;
use EllipseSynergie\ApiResponse\Contracts\Response;

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

    public function index() {
        $artists = $this->artist->paginate();

        return $this->response->paginator($artists, new ArtistTransformer());
    }

    public function show($id) {
        $artist = $this->artist->find($id);

        if(!$artist) {
            $this->response->errorNotFound();
        }

        return $this->response->item($artist, new ArtistTransformer());
    }

    public function showOriginalSongs($id) {
        $artist = $this->artist->find($id);

        if(!$artist) {
            $this->response->errorNotFound();
        }

        return $this->response->paginator($artist->originalSongs()->paginate(), new OriginalSongTransformer());
    }
}