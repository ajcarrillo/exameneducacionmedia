<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 04/02/2019
 * Time: 09:35 PM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use MediaSuperior\Models\Aula;
use MediaSuperior\Models\SedeAlterna;

class AulaController extends Controller
{

    public function create($sede_id)
    {
        $sede = SedeAlterna::find($sede_id);

        return view('media_superior.administracion.aulas.create', compact('sede'));
    }

    public function store(Request $request)
    {

        $sedeAlterna = SedeAlterna::find($request->input('sede_id'));

        //dd($sedeAlterna->aulas);
        $sedeAlterna->aulas()->create([
            'referencia' => $request->get('referencia'),
            'capacidad' => $request->get('capacidad'),
        ]);


        flash('El aula de  la sede alterna se guardó correctamente')->success();
        if ($request->has('addanother')) {
            return back();
        }

        return redirect(route('media.administracion.sedesAlternas.aulas',$request->input('sede_id')));
    }

    public function destroy($id)
    {
        $aula=Aula::find($id);
        //dd($aula);

        Aula::destroy($id);


        return redirect()->route('media.administracion.sedesAlternas.aulas',$aula->edificio_id);
    }

}