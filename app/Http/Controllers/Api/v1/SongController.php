<?php namespace App\Http\Controllers\Api\v1;

use App\Models\Like;
use App\Models\Song;
use App\Transformers\OriginalSongTransformer;
use App\Transformers\SongTransformer;

/**
 * Song resource representation.
 *
 * @Resource("Songs", uri="/songs")
 */
class SongController extends BaseController
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function index() {
        $songs = $this->song->orderBy('id', 'desc')->paginate(12);

        return $this->response->paginator($songs, new SongTransformer());
    }

    public function show($id) {
        $song = $this->song->find($id);

        if(!$song) {
            $this->response->errorNotFound();
        }

        return $this->response->item($song, new SongTransformer());
    }

    public function showOriginalSong($id) {
        $song = $this->song->find($id);

        if(!$song) {
            $this->response->errorNotFound();
        }

        return $this->response->item($song->originalSong, new OriginalSongTransformer());
    }

    public function existsLike($id)
    {
        $song = $this->song->find($id);

        if(!$song) {
            $this->response->errorNotFound();
        }

        if(Like::where([
            ['user_id', '=', app('auth')->id()],
            ['song_id', '=', $id]
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
            ['song_id', '=', $id]
        ])->first();

        if (is_null($like)) {
            Like::create([
                'user_id' => app('auth')->id(),
                'song_id' => $id
            ]);

            return $this->response
                ->array(['message' => 'Like created successfully.'])
                ->setStatusCode(201);
        } else {
            if (is_null($like->deleted_at)) {
                $like->delete();

                return $this->response->noContent();
            } else {
                $like->restore();

                return $this->response
                    ->array(['message' => 'Like created successfully.'])
                    ->setStatusCode(201);
            }
        }
    }
}