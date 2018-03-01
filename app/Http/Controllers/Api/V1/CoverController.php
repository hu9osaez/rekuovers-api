<?php namespace App\Http\Controllers\Api\V1;

use App\Exceptions\CoverDoesNotExistException;
use App\Models\Cover;

class CoverController extends BaseController
{
    /**
     * @var Cover $cover
     */
    private $cover;

    public function __construct(Cover $cover)
    {
        $this->cover = $cover;
    }

    public function index() {
        if(empty(request()->query())) {
            $covers = $this->cover
                ->latest()
                ->paginate();
        }
        else {
            $covers = $this->cover
                ->filter(request()->query())
                ->paginate();
        }

        return responder()->success($covers)->respond();
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
            ->take(10)
            ->get();

        return responder()->success($covers)->respond();
    }

    public function show($uuid) {
        $cover = $this->cover->whereUuid($uuid)->first();

        if(!$cover) {
            throw new CoverDoesNotExistException();
        }

        return responder()->success($cover)->respond();
    }
}
