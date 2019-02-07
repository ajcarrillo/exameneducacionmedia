<?php

namespace Aspirante\Http\Controllers;

use Aspirante\Models\Pregunta;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class CuestionarioController extends Controller
{
    /*
     * Capturar cuestionario
     * Obtener las preguntas padre e hijos, mediante el diccionario
     * obtener las respuestas de las preguntas hijo. utilizando las
     * relaciones entre las tablas.
     */
    public function index(Request $request)
    {
        $preguntas = Pregunta::with('hijos','hijos.diccionario','hijos.diccionario.respuestas')
            ->whereNull('padre_id')
            ->orderBy('id')
            ->paginate(7);

        $page = $preguntas->currentPage();

        if ($request->ajax()) {
            return response()->json(view('aspirante.cuestionario._preguntas', compact('preguntas', 'page'))->render());
        }
        return view('aspirante.cuestionario.form_cuestionario', compact('preguntas', 'page'));
    }

    public function store(Request $request)
    {
        dd($request);
    }
}