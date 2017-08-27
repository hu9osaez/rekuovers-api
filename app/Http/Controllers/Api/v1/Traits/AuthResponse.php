<?php namespace App\Http\Controllers\Api\v1\Traits;

use App\Models\Authorization;
use App\Transformers\AuthorizationTransformer;

/**
 * @property \Dingo\Api\Http\Response\Factory $response
 */
trait AuthResponse {
    public function authWithJwt($tokens) {
        $authorization = new Authorization($tokens);

        return $this->response->item($authorization, new AuthorizationTransformer())->statusCode(201);
    }
}
