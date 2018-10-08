<?php

namespace ExamenEducacionMedia\Http\Controllers\API;

use ExamenEducacionMedia\Models\Geodatabase\Inegi;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class LocalidadController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $localidades = Inegi::getLocalidadesPorMunicipio(request('cve_ent'), request('cve_mun'));

        return $this->respondWithArray(compact('localidades'));
    }
}
