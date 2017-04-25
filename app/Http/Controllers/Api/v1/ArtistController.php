<?php namespace App\Http\Controllers\Api\v1;

use App\Artist;
use App\Transformers\ArtistTransformer;

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
            return $this->response->errorNotFound();
        }

        return $this->response->item($artist, new ArtistTransformer());
    }
}