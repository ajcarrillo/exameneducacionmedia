<?php

namespace Subsistema\Http\Controllers\API;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\EtapaProceso;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Subsistema\Models\Subsistema;

class SubsistemaController extends Controller
{
    use ResponseTrait;

    public function show(Subsistema $subsistema)
    {
        $subsistema->loadMissing(
            [
                'planteles',
                'planteles.responsable',
                'planteles.municipio',
                'planteles.localidad',
                'especialidades',
                'planteles.aulas',
                'planteles.ofertaEducativa.grupos',
                'revisionAforos' => function ($query) {
                    return $query->orderBy('id', 'desc')->first();
                },
                'revisionAforos.review',
                'revisiones' => function ($query) {
                    return $query->orderBy('id', 'desc')->first();
                },
                'revisiones.review',
            ]
        );

        $isAforo  = EtapaProceso::isAforo();
        $isOferta = EtapaProceso::isOferta();
        $estado   = is_null($subsistema->revisionAforos->first()) ? 'sr' : $subsistema->revisionAforos->first()->review->estado;

        $reviewOferta = $subsistema->revisiones->first();
        $ofertaEstado   = is_null($reviewOferta) ? 'sr' : $reviewOferta->review->estado;

        return $this->respondWithArray(compact('subsistema', 'isAforo', 'estado', 'isOferta', 'ofertaEstado'));
    }
}
