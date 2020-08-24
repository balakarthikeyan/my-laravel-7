<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
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
        $arr = [
            'Bangladesh',
            'America',
            'Canada',
            'Brasil'
        ];
        if(in_array($request->country,$arr)){
            dd("{$request->country} is available in this array");
        }
        return $next($request);
    }
}
