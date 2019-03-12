<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-12
 * Time: 12:51
 */

namespace Aspirante\Http\Middleware;


use Closure;

class HasRevision
{
    public function handle($request, Closure $next)
    {
        $aspirante = get_aspirante();

        if ($aspirante->revision()->exists()) {
            abort(403, 'Tu registro ha sido enviado, no puedes modificar tus datos');
        }

        return $next($request);
    }
}
