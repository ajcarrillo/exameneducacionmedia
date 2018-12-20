<?php

namespace Subsistema\Http\Controllers\API;

use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\Subsistema;

class SubsistemaController extends Controller
{
    use ResponseTrait;

    public function show(Subsistema $subsistema)
    {
        $subsistema->loadMissing(
            'planteles',
            'planteles.responsable',
            'planteles.municipio',
            'planteles.localidad',
            'especialidades'
        );

        return $this->respondWithArray(compact('subsistema'));
    }
}
