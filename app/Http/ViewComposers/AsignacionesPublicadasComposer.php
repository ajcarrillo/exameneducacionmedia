<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-07-13
 * Time: 12:35
 */

namespace ExamenEducacionMedia\Http\ViewComposers;

use Illuminate\View\View;

class AsignacionesPublicadasComposer
{
    public function compose(View $view)
    {
        $view->with([
            'asignacionesPublicadas' => config('app.asignaciones_publicadas'),
        ]);
    }
}
