<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-29
 * Time: 08:56
 */

namespace ExamenEducacionMedia\Http\Controllers\API;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Plantel;

class PlantelController extends Controller
{

    public function index()
    {
        $planteles = Plantel::where('cve_ent', 23)
            ->where('cve_mun', request('cve_mun'))
            ->where('cve_loc', request('cve_loc'))
            ->orderBy('descripcion')
            ->get();

        return ok(compact('planteles'));
    }

}
