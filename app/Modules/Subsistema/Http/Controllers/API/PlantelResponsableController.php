<?php

namespace Subsistema\Http\Controllers\API;

use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Traits\ResponseTrait;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use Subsistema\Models\Plantel;

class PlantelResponsableController extends Controller
{
    use ResponseTrait;

    public function store(Request $request, $plantel)
    {
        try {
            $p = Plantel::where('uuid', $plantel)->firstOrFail();
            $responsable = DB::transaction(function () use ($request, $p) {
                $user = User::createUser($request->only([ 'nombre_completo', 'email', 'password' ]), [ 'plantel' ]);
                $p->responsable()->associate($user)->save();

                return $p->responsable;
            });

            return ok([ 'responsable' => $responsable ]);
        } catch (\Throwable $e) {
            return $this->setException($e)->respondeWithErrorsException();
        }
    }
}
