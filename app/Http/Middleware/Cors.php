<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
        ->header('Access-Control-Allow-Origin', "http://localhost:3000")
        ->header('Access-Control-Allow-Origin', "http://localhost:8000")
        ->header('Access-Control-Allow-Origin', "*")
        ->header('Access-Control-Allow-Headers', "Accept,Authorization,origin, x-requested-with, Content-type")
        ->header('Access-Control-Allow-Methods', "PUT, GET, POST, DELETE, OPTIONS");
    }
}
