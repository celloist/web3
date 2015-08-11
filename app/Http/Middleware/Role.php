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
        var_dump($request->user() != null);
        if ($request->user() == null || !$request->user()->hasRole(explode('|', $roles))) {
            return redirect()->route($route);
        }

        return $next($request);
    }
}
