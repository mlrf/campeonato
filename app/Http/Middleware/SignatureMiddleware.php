<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $headerName = 'X-Name')
    {
        //Add a new custom header to the response : only for api
        $response = $next($request);
        $response->headers->set($headerName, config('app.name'));
        return $response;

    }

}
