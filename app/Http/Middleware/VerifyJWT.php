<?php namespace App\Http\Middleware;

use Closure;
use Dingo\Api\Routing\Helpers;

class VerifyJWT
{
    use Helpers;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Check token
            // Si el token esta expirado, llamar a refresh token desde endpoint
            // Devolver tokens nuevos y guardar en cliente
            if (($errors = auth('jwt')->validateToken('api_token')) === true) {
                if (auth('jwt')->tokenIsApi()) {
                    if (auth ( 'jwt' )->guest ()) {
                        $this->response->errorUnauthorized ();
                    }
                }
            }
            else {
                $this->response->error($errors['message'], $errors['code']);
            }
        }
        else {
            $this->response->error('Request must accept a json response.', 422);
        }

        return $next($request);
    }
}
