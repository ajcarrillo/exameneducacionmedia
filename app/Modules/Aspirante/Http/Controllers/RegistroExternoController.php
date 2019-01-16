<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:49
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\Geodatabase\Pais;

class RegistroExternoController extends Controller
{
    public function __invoke()
    {
        $paises = Pais::selectPaises();
        $generos = [ 'H' => 'HOMBRE', 'M' => 'MUJER' ];

        return view('aspirante.registro_externo', compact('paises', 'generos'));
    }
}
