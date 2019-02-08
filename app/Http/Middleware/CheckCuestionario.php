<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Aspirante\Models\AspiranteRespuesta;
use Closure;

class CheckCuestionario
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
        $aspirante = get_aspirante();
        $existe = AspiranteRespuesta::where('aspirante_id', $aspirante->id)->first();

        $aviso = "El cuestionario ceneval ya fue repondido por el aspirante.";
        if ($existe) {
            return redirect()->route('aspirante.aviso.aspirante', compact('aviso'));
        }

        return $next($request);
    }
}
