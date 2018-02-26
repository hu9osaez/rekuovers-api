<?php namespace App\Http\Controllers\Api\V1;

use App\Exceptions\CoverDoesNotExistException;
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
        $cover = $this->cover->whereUuid($uuid)->first();

        if(!$cover) {
            throw new CoverDoesNotExistException();
        }

        $like = Like::where([
            ['cover_id', '=', $cover->id],
            ['user_id', '=', auth()->id()]
        ]);

        if(!$like->exists()) {
            return responder()->error()->respond(404);
        }

        return responder()->success()->respond();
    }

    public function store($uuid) {
        $cover = $this->cover->whereUuid($uuid)->first();

        if(!$cover) {
            throw new CoverDoesNotExistException();
        }

        $like = Like::withTrashed()
            ->whereCoverId($cover->id)
            ->whereUserId(auth()->user()->id)
            ->first();

        if(!$like) {
            Like::create([
                'user_id' => auth()->user()->id,
                'cover_id' => $cover->id
            ]);

            return responder()
                ->success(['message' => 'Like created successfully.'])
                ->respond(201);
        }
        else {
            if($like->deleted_at) {
               $like->restore();

                return responder()
                    ->success(['message' => 'Like created successfully.'])
                    ->respond(201);
            }
            else {
                return responder()
                    ->error(null, 'You\'ve already liked this cover.')
                    ->respond(409);
            }
        }
    }

    public function delete($uuid) {
        $cover = $this->cover->whereUuid($uuid)->first();

        if(!$cover) {
            throw new CoverDoesNotExistException();
        }

        $like = Like::whereCoverId($cover->id)
            ->whereUserId(auth()->user()->id)
            ->first();

        if($like) {
            $like->delete();

            return responder()
                ->success(['message' => 'Like deleted successfully.'])
                ->respond();
        }
        else {
            return responder()
                ->error(null, 'You have not liked this cover.')
                ->respond(404);
        }
    }
}
