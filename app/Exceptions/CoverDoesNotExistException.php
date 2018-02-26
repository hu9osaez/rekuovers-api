<?php namespace App\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class CoverDoesNotExistException extends HttpException
{
    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $status = Response::HTTP_NOT_FOUND;

    /**
     * The error code.
     *
     * @var string|null
     */
    protected $errorCode = 'cover_does_not_exist';

    /**
     * The error message.
     *
     * @var string|null
     */
    protected $message = 'The requested cover does not exist.';
}
