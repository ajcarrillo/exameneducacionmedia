<?php

namespace Aspirante\Http\Controllers;

use Aspirante\Models\Pregunta;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class CuestionarioController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::with('hijos')
            ->whereNull('padre_id')
            ->get();

        return view('aspirante.cuestionario.captura_cuestionario', compact('preguntas'));
    }
}
