<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin' , '*')
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');

        return $response;
    }
}
