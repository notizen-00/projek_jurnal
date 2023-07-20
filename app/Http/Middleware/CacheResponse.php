<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $key = $request->fullUrl();

        if (cache()->has($key)) {
            return cache()->get($key);
        }
        
        $response = $next($request);
        
        $content = $response->getContent();
        $cacheTime = 60; // waktu cache dalam menit
        cache()->put($key, $content, $cacheTime);
        
        return $response;
    }
}
