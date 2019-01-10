<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-10
 * Time: 12:30
 */

namespace Subsistema\Http\Controllers\API;

use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Subsistema\Models\Plantel;

class ActualizaNombrePlantelController extends Controller
{
    public function update(Request $request, Plantel $plantel)
    {
        $plantel->update([
            'descripcion' => "{$plantel->municipio->NOM_MUN} / {$request->input('nombre')}",
        ]);

        return ok([ 'nombre' => $plantel->descripcion ]);
    }
}
