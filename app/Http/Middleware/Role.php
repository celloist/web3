<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $route)
    {
        if (!$request->user()->hasRole(explode('|', $roles))) {
            redirect()->route($route);
        }

        return $next($request);
    }
}
