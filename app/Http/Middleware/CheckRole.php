<?php

namespace ExamenEducacionMedia\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        if ( ! $request->user()->hasRole($params)) {
            abort(401, 'No tienes permisos para entrar a esta sección del sistema, si crees que esto es un error comunicate con el área responsable');
        }

        return $next($request);
    }
}
