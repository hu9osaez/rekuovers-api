<?php namespace App\Http\Traits;

use App\Models\Authorization;
use App\Transformers\AuthorizationTransformer;

trait AuthResponse {
    public function token($token) {
        $authorization = new Authorization($token);

        return $this->response->item($authorization, new AuthorizationTransformer())->statusCode(201);
    }
}
