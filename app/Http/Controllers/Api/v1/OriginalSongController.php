<?php namespace App\Http\Controllers\Api\v1;

use App\OriginalSong;
use App\Transformers\OriginalSongTransformer;

class OriginalSongController extends BaseController
{
    private $originalSong;

    public function __construct(OriginalSong $originalSong)
    {
        $this->originalSong = $originalSong;
    }

    public function show($id) {
        $originalSong = $this->originalSong->find($id);

        if(!$originalSong) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($originalSong, new OriginalSongTransformer());
    }
}
