<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitMiddleware
{

    public function handle(
        $request,
        Closure $next
    ){

        $key=
        'api-'.$request->ip();

        if(
            RateLimiter::tooManyAttempts(
                $key,
                60
            )
        ){

            abort(
                429,
                'Too many requests'
            );

        }

        RateLimiter::hit($key);

        return $next($request);

    }

}