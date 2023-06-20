<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (\Auth::check() && $request->user()->checkRole($roles)) {
            return $next($request);
        }
        abort(403);
    }
}
