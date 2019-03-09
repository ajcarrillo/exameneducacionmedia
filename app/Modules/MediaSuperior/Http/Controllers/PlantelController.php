<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-08
 * Time: 13:54
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Subsistema\Models\Filters\PlantelFilter;
use Subsistema\Models\Plantel;
use Subsistema\Models\Subsistema;

class PlantelController extends Controller
{
    public function index(Request $request, PlantelFilter $filters)
    {
        $planteles = Plantel::with('responsable', 'subsistema')
            ->filterBy($filters, $request->only([ 'subsistema', 'search' ]))
            ->orderBy('descripcion')
            ->get();

        $subsistemas = Subsistema::orderBy('referencia')
            ->get([ 'id', 'referencia' ]);

        return view('administracion.planteles.index', compact('planteles', 'subsistemas'));
    }
}
