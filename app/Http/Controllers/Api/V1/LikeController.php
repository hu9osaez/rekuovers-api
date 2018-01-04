<?php namespace App\Http\Controllers\Api\V1;

use App\Models\Cover;
use App\Models\Like;

class LikeController extends BaseController
{
    private $cover;

    public function __construct(Cover $cover)
    {
        $this->cover = $cover;
    }

    public function exists($uuid)
    {
        $cover = $this->cover->byUuid($uuid);

        if(!$cover) {
            return responder()->error()->respond(404);
        }

        $like = Like::where([
            ['cover_id', '=', $cover->id],
            ['user_id', '=', auth()->user()->id]
        ]);

        if(!$like->exists()) {
            return responder()->error()->respond(404);
        }

        return responder()->success()->respond();
    }

    public function store($uuid) {
        $cover = $this->cover->byUuid($uuid);

        if(!$cover) {
            return responder()->error()->respond(404);
        }

        $like = Like::withTrashed()->where([
            ['cover_id', '=', $cover->id],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        if (is_null($like)) {
            Like::create([
                'user_id' => auth()->user()->id,
                'cover_id' => $cover->id
            ]);

            return responder()->success(['message' => 'Like created successfully.'])->respond(201);
        }
        else {
            if (is_null($like->deleted_at)) {
                $like->delete();

                return responder()->success()->respond(204);
            }
            else {
                $like->restore();

                return responder()->success(['message' => 'Like created successfully.'])->respond(201);
            }
        }
    }
}
