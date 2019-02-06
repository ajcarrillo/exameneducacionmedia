<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:05
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Models\Seleccion;

class DashboardController
{
    public function index()
    {
        $aspirante = get_aspirante();

        $ofertas = Seleccion::with('ofertaEducativa', 'ofertaEducativa.plantel', 'ofertaEducativa.especialidad')
                    ->where('aspirante_id', $aspirante->id)
                    ->orderBy('preferencia', 'asc')
                    ->get();

        return view('aspirante.dashboard', compact('ofertas','ofertas_gral'));
        
    }
}
