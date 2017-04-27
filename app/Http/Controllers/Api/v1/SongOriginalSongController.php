<?php namespace App\Http\Controllers\Api\v1;


use App\OriginalSong;
use App\Song;
use App\Transformers\OriginalSongTransformer;

class SongOriginalSongController extends BaseController
{
    protected $song;
    protected $originalSong;

    public function __construct(Song $song, OriginalSong $originalSong)
    {
        $this->song = $song;
        $this->originalSong = $originalSong;
    }

    public function show($id) {
        $song = $this->song->find($id);
        $originalSong = $this->originalSong->find($song->original_song_id);

        if(!$song) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($originalSong, new OriginalSongTransformer());
    }
}