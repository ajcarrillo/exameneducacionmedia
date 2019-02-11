<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:05
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Models\Aspirante;
use Aspirante\Models\Seleccion;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $aspirante = get_aspirante();

        $ofertas_gral = DB::table('seleccion_ofertas_educativas as sel_of')
            ->join('ofertas_educativas as oferta', 'sel_of.oferta_educativa_id', '=', 'oferta.id')
            ->join('especialidades as esp', 'oferta.especialidad_id', '=', 'esp.id')
            ->join('planteles as plantel', 'oferta.plantel_id', '=', 'plantel.id')
            ->join('aspirantes', 'sel_of.aspirante_id', '=', 'aspirantes.id')
            ->select('plantel.latitud', 'plantel.longitud', 'sel_of.preferencia', 'esp.referencia', 'plantel.descripcion as plantel_desc', 'esp.descripcion as esp_desc')
            ->where('aspirantes.id', $aspirante->id)
            ->groupBy('plantel.id')
            ->get();

        $ofertas = Seleccion::with([ 'ofertaEducativa', 'ofertaEducativa.plantel', 'ofertaEducativa.especialidad' ])
            ->where('aspirante_id', $aspirante->id)
            ->orderBy('preferencia', 'asc')
            ->get();

        $revision        = $this->getRevision($aspirante);
        $hasRevision     = $this->hasRevision($aspirante);
        $paseAlExamen    = $this->getPaseAlExamen($aspirante);
        $hasPaseAlExamen = $this->hasPaseAlExamen($aspirante);

        return view('aspirante.dashboard', compact(
            'ofertas', 'ofertas_gral', 'revision', 'hasRevision',
            'paseAlExamen', 'hasPaseAlExamen'
        ));
    }

    protected function getRevision(Aspirante $aspirante)
    {
        return $aspirante->revisiones()->first();
    }

    protected function hasRevision(Aspirante $aspirante)
    {
        return $aspirante->revisiones()->exists();
    }

    protected function getPaseAlExamen(Aspirante $aspirante)
    {
        return $aspirante->paseExamen;
    }

    public function hasPaseAlExamen(Aspirante $aspirante)
    {
        return $aspirante->paseExamen()->exists();
    }
}
