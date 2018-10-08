<?php

namespace ExamenEducacionMedia\Http\Controllers\API;

use ExamenEducacionMedia\Models\Geodatabase\Inegi;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class MunicipioController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $municipios = Inegi::getMunicipiosPorEntidad(request('cve_ent'));

        return $this->respondWithArray(compact('municipios'));
    }
}
