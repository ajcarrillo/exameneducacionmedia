<?php

namespace Aspirante\Http\Controllers;

use Aspirante\Models\Pregunta;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class CuestionarioController extends Controller
{
    /*
     * Capturar cuestionario
     * Obtener las preguntas padre e hijos mediante el diccionario
     * obtener las respuestas de las preguntas hijo. utilizando las
     * relaciones entre las tablas.
     */
    public function index()
    {
        $preguntas = Pregunta::with('hijos','hijos.diccionario','hijos.diccionario.respuestas')
            ->whereNull('padre_id')
            ->get();
        return view('aspirante.cuestionario.captura_cuestionario', compact('preguntas'));
    }
}