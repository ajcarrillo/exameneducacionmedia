<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 17:20
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Plantel;

class UpdatePlantelDescuentoController extends Controller
{
    public function udpate(Plantel $plantel)
    {
        $plantel->update([ 'descuento' => request('descuento') ]);

        return ok();
    }
}
