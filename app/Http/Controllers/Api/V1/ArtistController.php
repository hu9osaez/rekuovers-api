<?php namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ArtistResource;
use App\Models\Artist;

class ArtistController extends BaseController {

    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function search() {
        $q = request()->input('q');

        if(is_null($q)) {
            abort(400);
        }

        $results = $this->artist
            ->where('name', 'like', "%{$q}%")
            ->orWhere('slug', 'like', "%{$q}%")
            ->get();

        return ArtistResource::collection($results);
    }

    /**
     * @param $uuid
     * @return ArtistResource
     */
    public function show($uuid) {
        $artist = $this->artist->byUuid($uuid);

        if(!$artist) {
            abort(404);
        }

        return new ArtistResource($artist);
    }
}
