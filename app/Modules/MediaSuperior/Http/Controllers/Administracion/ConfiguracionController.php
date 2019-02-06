<?php

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaSuperior\Models\Configuracion;

class ConfiguracionController extends Controller
{
    public function index(Request $request)
    {
        $configs = Configuracion::all();
        return view('configuracion.index', compact('configs'));
    }

    public function update(Request $request)
    {
        $configuraciones = $request->configuracion;

        foreach ($configuraciones as $id => $config) {
            $configuracion        = Configuracion::find($id);
            $configuracion->valor = $config;
            $configuracion->save();
        }

        return redirect()->route('media.administracion.configuracion.index');
    }
}
