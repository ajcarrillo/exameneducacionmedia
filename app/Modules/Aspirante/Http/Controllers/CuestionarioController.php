<?php

namespace Aspirante\Http\Controllers;

use Aspirante\Models\AspiranteRespuesta;
use Aspirante\Models\Pregunta;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Exception;

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
        $aspirante = get_aspirante();
        $existe = AspiranteRespuesta::where('aspirante_id', $aspirante->id)->first();

        $aviso = "El cuestionario ceneval ya fue repondido por el aspirante";

        if ($existe) {
            return view('aspirante.cuestionario.aviso_aspirante', ['aviso' => $aviso]);
        }

        $preguntas = Pregunta::with('hijos','hijos.diccionario','hijos.diccionario.respuestas')
            ->whereNull('padre_id')
            ->orderBy('id')
            ->paginate(7);

        $page = $preguntas->currentPage();
	    $lastPage = $preguntas->lastPage();

        if ($request->ajax()) {
            return response()->json(view('aspirante.cuestionario._preguntas', compact('preguntas', 'page', 'lastPage'))->render());
        }
        return view('aspirante.cuestionario.form_cuestionario', compact('preguntas', 'page', 'lastPage'));
    }

    public function store(Request $request)
    {
        try {
            $aspirante = get_aspirante();
            $cuestionario = ($request->input("preguntas"));
            $aviso = '';

            foreach ($cuestionario as $clave => $valor) {
               $aspiranteRespuesta = new AspiranteRespuesta;
                $aspiranteRespuesta->aspirante_id = $aspirante->id;
                $aspiranteRespuesta->pregunta_id = $clave;
                $aspiranteRespuesta->respuesta_id = $valor;
                $aspiranteRespuesta->save();

                if (!$aspiranteRespuesta) {
                    throw new Exception("Error al guardar los datos.");
                }
            }

            $aviso = "El cuestionario ceneval fue respondido exitosamente.";
            return view('aspirante.cuestionario.aviso_aspirante', ['aviso' => $aviso]);

        } catch (Exception $e) {
            flash($e->getMessage())->warning();
            return redirect()->back();
        }
    }
}