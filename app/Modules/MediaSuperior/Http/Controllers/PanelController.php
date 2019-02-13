<?php

namespace MediaSuperior\Http\Controllers;

use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;

class PanelController extends Controller
{
    public function index()
    {
        $usuario_id = Auth::user()->id;
        return view('administracion.home');
    }
}
