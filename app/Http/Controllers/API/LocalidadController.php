<?php

namespace ExamenEducacionMedia\Http\Controllers\API;

use ExamenEducacionMedia\Models\Geodatabase\Inegi;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class LocalidadController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $localidades = Inegi::getLocalidadesPorMunicipio('23', request('municipio_id'));

        return $this->respondWithArray(compact('localidades'));
    }
}
