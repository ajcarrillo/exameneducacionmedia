<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Closure;
use ExamenEducacionMedia\Models\EtapaProceso;

class CheckForAforoMode
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
        if ( ! EtapaProceso::isAforo()) {
            abort(500);
        }

        return $next($request);
    }
}
