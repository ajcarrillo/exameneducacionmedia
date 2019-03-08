<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 17:59
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Plantel;

class UpdatePlantelOpcionesController extends Controller
{
    public function udpate(Plantel $plantel)
    {
        $plantel->update([ 'opciones' => request('opciones') ]);

        return ok();
    }
}
