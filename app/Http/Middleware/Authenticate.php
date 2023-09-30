<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Auth;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::guard('api')->check()) {
            return response()->json('Unauthorized', 403);
        }

        return $next($request);
    }
}
