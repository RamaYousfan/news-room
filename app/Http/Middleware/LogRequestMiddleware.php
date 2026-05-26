<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{

    public function handle(
        $request,
        Closure $next
    ){

        $start = microtime(true);

        $response =
            $next($request);

        Log::info(

            'API Request',

            [

                'url' =>
                $request->url(),

                'method' =>
                $request->method(),

                'user' =>
                auth()->id(),

                'duration' =>
                microtime(true)-$start

            ]

        );

        return $response;

    }

}