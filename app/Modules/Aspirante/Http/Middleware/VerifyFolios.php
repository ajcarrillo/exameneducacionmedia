<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 12:51
 */

namespace Aspirante\Http\Middleware;


use Closure;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;

class VerifyFolios
{

    public function handle($request, Closure $next)
    {
        if ( ! Folio::whereActive(true)->exists()) {
            abort(403, 'No existen folios disponibles');
        }

        return $next($request);
    }

}
