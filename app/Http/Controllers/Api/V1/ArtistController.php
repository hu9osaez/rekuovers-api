<?php namespace App\Http\Controllers\Api\V1;

use App\Models\Artist;

class ArtistController extends BaseController {

    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search() {
        $q = request()->input('q');

        if(is_null($q)) {
            return responder()->error()->respond(400);
        }

        $result = $this->artist
            ->where('name', 'like', "%{$q}%")
            ->orWhere('slug', 'like', "%{$q}%")
            ->paginate();

        return responder()->success($result)->respond();
    }

    /**
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($uuid) {
        $artist = $this->artist->byUuid($uuid);

        if(!$artist) {
            return responder()->error()->respond(404);
        }

        return responder()->success($artist)->respond();
    }
}
