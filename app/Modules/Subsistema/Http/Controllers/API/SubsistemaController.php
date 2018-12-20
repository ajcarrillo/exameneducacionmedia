<?php

namespace Subsistema\Http\Controllers\API;

use ExamenEducacionMedia\Models\Subsistema;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class SubsistemaController extends Controller
{
    use ResponseTrait;

    public function show(Subsistema $subsistema)
    {
        $subsistema->loadMissing('planteles', 'planteles.responsable', 'planteles.domicilio', 'especialidades');

        return $this->respondWithArray(compact('subsistema'));
    }
}
