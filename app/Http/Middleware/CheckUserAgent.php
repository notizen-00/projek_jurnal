<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAgent
{
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');

        if ($this->isMobile($userAgent)) {
            abort(403,'Tidak Bisa Menggunakan HP');
        }

        return $next($request);
    }

    private function isMobile($userAgent)
    {
        // Use regular expressions or any other method to determine if the user agent is from a mobile device
        // Here's a simple example using a regular expression
        $pattern = "/(Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone)/i";
        return preg_match($pattern, $userAgent);
    }
}