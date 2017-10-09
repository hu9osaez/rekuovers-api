<?php namespace App\Http\Controllers\Api\V1;

use App\Models\Like;
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
            ->orderBy('created_at', 'desc')
            ->paginate();

        return responder()->success($covers)->respond();
    }

    public function popular() {
        $covers = $this->cover->withCount('likes')
            ->having('likes_count', '>=', 10)
            ->orderBy('likes_count', 'desc')
            ->take(100)
            ->get();

        return responder()->success($covers)->respond();
    }

    public function search() {
        $q = request()->input('q');

        if(is_null($q)) {
            return responder()->error()->respond(400);
        }

        $result = $this->cover->whereHas('song', function($query) use ($q) {
            $query->where('title', 'like', "%{$q}%");
            $query->orWhere('slug', 'like', "%{$q}%");
        })
        ->paginate();

        return responder()->success($result)->respond();
    }

    public function show($uuid) {
        $cover = $this->cover->byUuid($uuid);

        if(!$cover) {
            return responder()->error()->respond(404);
        }

        return responder()->success($cover)->respond();
    }

    /*
    public function existsLike($id)
    {
        $cover = $this->cover->find($id);

        if(!$cover) {
            $this->response->errorNotFound();
        }

        if(Like::where([
            ['user_id', '=', app('auth')->id()],
            ['cover_id', '=', $id]
        ])->exists()) {
            return $this->response->array([
                'message' => 'Like exists.'
            ]);
        }

        $this->response->errorNotFound();
    }

    public function storeLike($id) {
        $like = Like::withTrashed()->where([
            ['user_id', '=', app('auth')->id()],
            ['cover_id', '=', $id]
        ])->first();

        if (is_null($like)) {
            Like::create([
                'user_id' => app('auth')->id(),
                'song_id' => $id
            ]);

            return $this->response
                ->array(['message' => 'Like created successfully.'])
                ->setStatusCode(201);
        }
        else {
            if (is_null($like->deleted_at)) {
                $like->delete();

                return $this->response->noContent();
            }
            else {
                $like->restore();

                return $this->response
                    ->array(['message' => 'Like created successfully.'])
                    ->setStatusCode(201);
            }
        }
    }
    */
}
