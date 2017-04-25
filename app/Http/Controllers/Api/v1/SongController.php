<?php namespace App\Http\Controllers\Api\v1;


use App\Song;
use App\Transformers\SongTransformer;

class SongController extends BaseController
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function index() {
        $songs = $this->song->paginate(12);
        return $this->response->paginator($songs, new SongTransformer());
    }

    public function show($id) {
        $song = $this->song->withCount('likes')->find($id);

        if(!$song) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($song, new SongTransformer());
    }
}