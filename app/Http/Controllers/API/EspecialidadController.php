<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-30
 * Time: 14:18
 */

namespace ExamenEducacionMedia\Http\Controllers\API;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\OfertaEducativa;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = OfertaEducativa::with([ 'especialidad' => function ($query) {
            $query->orderBy('referencia');
        }, 'plantel:id,descripcion,opciones' ])->onlyActive()
            ->where('plantel_id', request('plantel_id'))
            ->get();

        return ok(compact('especialidades'));
    }
}
