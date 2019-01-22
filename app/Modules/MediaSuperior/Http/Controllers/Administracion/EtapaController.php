<?php

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Models\EtapaProceso;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Carbon\Carbon;

class EtapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etapas = EtapaProceso::get();
        return view('media_superior.administracion.etapas.index', compact('etapas'));
    }

    public function edit()
    {
        $etapas = EtapaProceso::get();
        return view('media_superior.administracion.etapas.edit', compact('etapas'));
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
