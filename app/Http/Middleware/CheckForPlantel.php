<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Closure;

class CheckForPlantel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $request->user()->plantel) {
            abort(401, "Usted no es responsable de un plantel");
        }

        return $next($request);
    }
}
