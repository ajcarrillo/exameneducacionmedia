<?php

namespace Subsistema\Http\Middleware;

use Closure;

class CheckForSubsistema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $request->user()->subsistema) {
            abort(401, "Usted no es responsable de un subsistema");
        }

        return $next($request);
    }
}
