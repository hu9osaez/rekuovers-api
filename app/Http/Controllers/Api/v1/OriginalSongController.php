<?php namespace App\Http\Controllers\Api\v1;

use App\Models\OriginalSong;
use App\Transformers\ArtistTransformer;
use App\Transformers\OriginalSongTransformer;

/**
 * Original song resource representation.
 *
 * @Resource("Original Songs", uri="/original-songs")
 */
class OriginalSongController extends BaseController
{
    private $originalSong;

    public function __construct(OriginalSong $originalSong)
    {
        $this->originalSong = $originalSong;
    }

    public function index() {
        $originalSongs = $this->originalSong->paginate();

        return $this->response->paginator($originalSongs, new OriginalSongTransformer());
    }

    public function show($id) {
        $originalSong = $this->originalSong->find($id);

        if(!$originalSong) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($originalSong, new OriginalSongTransformer());
    }

    public function showArtists($id) {
        $originalSong = $this->originalSong->find($id);

        if(!$originalSong) {
            return $this->response->errorNotFound();
        }

        return $this->response->collection($originalSong->artists, new ArtistTransformer());
    }
}
