<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-12
 * Time: 13:07
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;

class ShowAspiranteController extends Controller
{
    public function __invoke()
    {
        $aspirante = get_aspirante();
        $aspirante->load(
            'opcionesEducativas', 'opcionesEducativas.ofertaEducativa',
            'opcionesEducativas.ofertaEducativa.especialidad', 'opcionesEducativas.ofertaEducativa.plantel'
        );

        return view('aspirante.show', compact('aspirante'));
    }
}
