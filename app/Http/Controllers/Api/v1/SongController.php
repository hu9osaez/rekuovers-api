<?php namespace App\Http\Controllers\Api\v1;

use App\Models\Song;
use App\Transformers\OriginalSongTransformer;
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
        $songs = $this->song->orderBy('id', 'desc')->paginate(12);

        return $this->response->paginator($songs, new SongTransformer());
    }

    public function show($id) {
        $song = $this->song->find($id);

        if(!$song) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($song, new SongTransformer());
    }

    public function showOriginalSong($id) {
        $song = $this->song->find($id);

        if(!$song) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($song->originalSong, new OriginalSongTransformer());
    }
}