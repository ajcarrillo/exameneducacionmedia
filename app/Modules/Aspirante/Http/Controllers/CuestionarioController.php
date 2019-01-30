<?php

namespace Aspirante\Http\Controllers;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('aspirante.cuestionario.captura_cuestionario');
    }
}
