<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Library\ApiHelpers;
use Illuminate\Contracts\Auth\Factory as Auth;

class Role
{
    use ApiHelpers;

    public function handle($request, Closure $next)
    {
        if (!auth('sanctum')->user()->isAdmin()) {
            return $this->onUnauthorized();
        }

        return $next($request);
    }
}
