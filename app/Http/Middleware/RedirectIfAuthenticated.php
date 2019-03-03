<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Closure;
use ExamenEducacionMedia\Traits\RedirectTo;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    use RedirectTo;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return $this->redirectTo(Auth::user());
        }

        return $next($request);
    }
}
