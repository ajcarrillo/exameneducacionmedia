<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
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
        $especialidades= OfertaEducativa::with('activar')->where('active', 1)->count('especialidad_id');
        $planteles = Plantel::where('active', 1)->count('id');
        $hoy = date("Y-m-d");
        $aspirantes_hoy= Aspirante::where('created_at', 'LIKE', '%'. $hoy.'%')->count('id');
        return view('administracion.home', compact('especialidades','planteles'));
    }
}