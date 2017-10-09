<?php namespace App\Http\Controllers\Api\V1;

use App\Models\Song;

class SongController extends BaseController
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function search() {
        $q = request()->input('q');

        if(is_null($q)) {
            return responder()->error()->respond(400);
        }

        $result = $this->song
            ->where('title', 'like', "%{$q}%")
            ->orWhere('slug', 'like', "%{$q}%")
            ->paginate();

        return responder()->success($result)->respond();
    }

    public function show($uuid) {
        $song = $this->song->byUuid($uuid);

        if(!$song) {
            return responder()->error()->respond(404);
        }

        return responder()->success($song)->respond();
    }
}
