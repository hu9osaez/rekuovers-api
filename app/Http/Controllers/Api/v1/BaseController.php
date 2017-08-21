<?php namespace App\Http\Controllers\Api\v1;

use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    /**
     * BaseController constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}