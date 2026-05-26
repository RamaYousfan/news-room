<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle(

        Request $request,

        Closure $next,

        string $role

    )
    {

        /** @var User|null $user */
        $user = Auth::user();


        if( !$user || !$user->hasRole($role)){abort(  403,'Unauthorized'  ); }



        return $next($request );  }

}