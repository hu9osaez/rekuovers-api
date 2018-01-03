<?php namespace App\Http\Controllers\Api\V1;

use App\Models\Cover;

class CoverController extends BaseController
{
    private $cover;

    public function __construct(Cover $cover)
    {
        $this->cover = $cover;
    }

    public function newest() {
        $covers = $this->cover
            ->latest()
            ->paginate();

        return responder()->success($covers)->respond();
    }

    public function popular() {
        $covers = $this->cover->withCount('likes')
            ->having('likes_count', '>=', 10)
            ->orderBy('likes_count', 'desc')
            ->take(7)
            ->get();

        return responder()->success($covers)->respond();
    }

    public function random() {
        $cover = $this->cover->inRandomOrder()->first();

        return responder()->success($cover)->respond();
    }

    public function search() {
        $q = request()->input('q');

        if(is_null($q)) {
            return responder()->error()->respond(400);
        }

        $result = $this->cover->search($q)->paginate();

        return responder()->success($result)->respond();
    }

    public function show($uuid) {
        $cover = $this->cover->byUuid($uuid);

        if(!$cover) {
            return responder()->error()->respond(404);
        }

        return responder()->success($cover)->respond();
    }
}
