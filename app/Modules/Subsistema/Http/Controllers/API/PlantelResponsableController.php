<?php

namespace Subsistema\Http\Controllers\API;

use DB;
use ExamenEducacionMedia\Models\Plantel;
use ExamenEducacionMedia\Traits\ResponseTrait;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class PlantelResponsableController extends Controller
{
    use ResponseTrait;

    public function store(Request $request, Plantel $plantel)
    {
        try {
            $responsable = DB::transaction(function () use ($request, $plantel) {
                $user = User::createUser($request->only([ 'nombre', 'primer_apellido', 'segundo_apellido', 'username', 'email', 'password' ]), [ 2 ]);
                $plantel->responsable()->associate($user)->save();

                return $plantel->responsable;
            });

            return $this->respondWithArray([ 'isValid' => true, 'responsable' => $responsable ]);
        } catch (\Throwable $e) {
            return $this->setException($e)->respondeWithErrorsException();
        }
    }
}
