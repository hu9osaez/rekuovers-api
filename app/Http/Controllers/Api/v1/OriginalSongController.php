<?php namespace App\Http\Controllers\Api\v1;

use App\Models\OriginalSong;
use App\Transformers\ArtistTransformer;
use App\Transformers\OriginalSongTransformer;

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

    public function showArtist($id) {
        $originalSong = $this->originalSong->find($id);

        if(!$originalSong) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($originalSong->artist, new ArtistTransformer());
    }
}
