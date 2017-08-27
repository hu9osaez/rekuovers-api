<?php

namespace App\Http\Middleware;

use Closure;

class JWTCheck
{
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
            if (($errors = auth('jwt')->validateToken('api_token')) === true) {
                if (auth('jwt')->tokenIsApi()) {
                    if (auth('jwt')->guest()) {
                        return response()->json('Unauthorized.', 401);
                    }
                }
            }
            else {
                return response()->json(['error' => $errors['message']], $errors['code']);
            }
        }
        else {
            return response()->json(['error' =>'Request must accept a json response.'], 422);
        }

        return $next($request);
    }
}
