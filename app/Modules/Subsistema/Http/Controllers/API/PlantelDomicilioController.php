<?php

namespace Subsistema\Http\Controllers\API;

use ExamenEducacionMedia\Models\Domicilio;
use ExamenEducacionMedia\Models\Plantel;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class PlantelDomicilioController extends Controller
{
    use ResponseTrait;

    public function store(Request $request, Plantel $plantel)
    {
        //todo: verificar que el plantel corresponda al subsistema que esta actualizando
        $domicilio = new Domicilio($request->input());
        $plantel->domicilio()->associate($domicilio)->save();

        $plantel->loadMissing('responsable', 'domicilio');

        return $this->respondWithArray(compact('plantel'));
    }

    public function update(Request $request, Plantel $plantel)
    {
        //todo: verificar que el plantel corresponda al subsistema que esta actualizando
    }
}
