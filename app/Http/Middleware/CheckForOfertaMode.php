<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Closure;
use ExamenEducacionMedia\Models\EtapaProceso;

class CheckForOfertaMode
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
        if ( ! EtapaProceso::isOferta()) {
            abort(403, "La etapa de oferta aún no empieza o ha terminado");
        }

        return $next($request);
    }
}
