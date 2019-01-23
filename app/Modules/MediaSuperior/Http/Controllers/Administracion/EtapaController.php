<?php

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Models\EtapaProceso;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;

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

    /**
     * GUARDAR ETAPAS
     * VALIDACIÓN DE FECHAS
     * Oferta: La oferta debe comenzar antes del Aforo y del Registro
     * Aforo: El aforo debe comenzar después de la Oferta y antes del Registro
     * Registro: Debe comenzar después de la Oferta y del Aforo
     */
    public function update(Request $request)
    {
        try {
            $etapas = $request->only('AFORO', 'OFERTA', 'REGISTRO');
            $ofertaApertura = $etapas['OFERTA']['apertura'];
            $ofertaCierre = $etapas['OFERTA']['cierre'];
            $aforoApertura = $etapas['AFORO']['apertura'];
            $aforoCierre = $etapas['AFORO']['cierre'];
            $registroApertura = $etapas['REGISTRO']['apertura'];
            $registroCierre = $etapas['REGISTRO']['cierre'];

            if ($ofertaCierre >= $ofertaApertura) {
            } else {
                throw new Exception("Etapa OFERTA: El cierre debe ser mayor o igual a la apertura");
            }
            if ($aforoApertura > $ofertaCierre) {
            } else {
                throw new Exception("El AFORO debe comenzar después de la OFERTA y antes del REGISTRO");
            }
            if ($aforoCierre >= $aforoApertura) {
            } else {
                throw new Exception("Etapa AFORO: El cierre debe ser mayor o igual a la apertura");
            }
            if ($registroApertura > $aforoCierre) {
            } else {
                throw new Exception("El REGISTRO Debe comenzar después de la OFERTA y del AFORO");
            }
            if ($registroCierre >= $registroApertura) {
            } else {
                throw new Exception("Etapa REGISTRO: El cierre debe ser mayor o igual a la apertura");
            }

            foreach ($etapas as $etapa) {
                $proceso = EtapaProceso::find($etapa['id']);
                $proceso->update([
                    'apertura' => $etapa['apertura'],
                    'cierre' => $etapa['cierre']
                ]);

                if (!$proceso) {
                    throw new Exception("Error al guardar los datos.");
                }
            }

            flash('Los datos fueron guardados correctamente.')->success();
            return redirect()->back();

        } catch (Exception $e) {

            flash($e->getMessage())->warning();
            return redirect()->back();
        }
    }
}
