<?php namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cover;

class MeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        $data = auth()->user();

        return responder()->success($data)->respond();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function likedCoversIds() {
        $covers = Cover::whereHas('likes', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->pluck('uuid')->toArray();

        return responder()->success($covers)->respond();
    }
}
