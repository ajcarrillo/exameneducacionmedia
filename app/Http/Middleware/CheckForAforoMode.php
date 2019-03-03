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
            abort(403, "La etapa de aforo aún no empieza o ha terminado");
        }

        return $next($request);
    }
}
