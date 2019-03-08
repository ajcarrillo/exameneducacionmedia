<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 13:54
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Plantel;

class PlantelController extends Controller
{
    public function index()
    {
        $planteles = Plantel::with('responsable', 'subsistema')
            ->orderBy('descripcion')
            ->get();

        return view('administracion.planteles.index', compact('planteles'));
    }
}
