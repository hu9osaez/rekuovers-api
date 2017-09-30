<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\CoverResource;
use App\Models\Like;
use App\Models\Cover;
use App\Transformers\CoverTransformer;

/**
 * Cover resource representation.
 *
 * @Resource("Covers", uri="/covers")
 */
class CoverController extends BaseController
{
    private $cover;

    public function __construct(Cover $cover)
    {
        $this->cover = $cover;
    }

    public function index() {
        $covers = $this->cover->orderBy('created_at', 'desc')->paginate(12);

        return CoverResource::collection($covers);
    }

    public function show($uuid) {
        $cover = $this->cover->byUuid($uuid);

        if(!$cover) {
            abort(404);
        }

        return new CoverResource($cover);
    }

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
}