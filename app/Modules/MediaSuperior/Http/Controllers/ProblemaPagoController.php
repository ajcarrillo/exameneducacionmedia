<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-23
 * Time: 00:57
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;

class ProblemaPagoController extends Controller
{
    public function index()
    {
        $billy = get_billy_url();
        $url   = "{$billy}/pagos/referencia";

        return view('administracion.pagos.problema.index', compact('url'));
    }
}
