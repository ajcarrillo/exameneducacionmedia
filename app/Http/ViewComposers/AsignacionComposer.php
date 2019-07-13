<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-07-13
 * Time: 12:14
 */

namespace ExamenEducacionMedia\Http\ViewComposers;

use Illuminate\View\View;

class AsignacionComposer
{
    public function compose(View $view)
    {
        $view->with([
            'hasAsignacion' => $this->hasAsignacion(),
        ]);
    }

    protected function hasAsignacion()
    {
        if ( ! $this->asignacionesPublicadas()) {
            return false;
        }

        $aspirante = get_aspirante();

        if ( ! $aspirante->asignacion()->exists() || ! optional($aspirante->asignacion)->ofertaEducativa()->exists()) {
            return false;
        }

        return true;
    }

    protected function asignacionesPublicadas()
    {
        return config('app.asignaciones_publicadas');
    }
}
