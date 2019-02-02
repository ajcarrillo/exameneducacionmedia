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
                'revisionAforos' => function ($query) {
                    return $query->orderBy('id', 'desc')->first();
                },
                'revisionAforos.review'
            ]
        );

        $isAforo = EtapaProceso::isAforo();
        $estado = is_null($subsistema->revisionAforos->first()) ? 'sr' : $subsistema->revisionAforos->first()->review->estado;

        return $this->respondWithArray(compact('subsistema', 'isAforo', 'estado'));
    }
}
