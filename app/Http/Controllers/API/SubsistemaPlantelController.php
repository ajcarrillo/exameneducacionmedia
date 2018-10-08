<?php

namespace ExamenEducacionMedia\Http\Controllers\API;

use DB;
use ExamenEducacionMedia\Models\Domicilio;
use ExamenEducacionMedia\Models\Plantel;
use ExamenEducacionMedia\Models\Subsistema;
use ExamenEducacionMedia\Traits\ResponseTrait;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class SubsistemaPlantelController extends Controller
{
    use ResponseTrait;

    public function store(Request $request)
    {
        $subsistema = Subsistema::find(1);
        try {
            DB::transaction(function () use ($request, $subsistema) {
                $plantel = $this->createPlantel($subsistema, $request->only([ 'descripcion', 'cct', 'pagina_web', 'telefono' ]));
                $this->createDomicilio($plantel, $request->only([ 'cve_ent', 'cve_mun', 'cve_loc', 'colonia', 'calle', 'numero', 'codigo_postal' ]));
                $this->createResponsible($plantel, $request->only([ 'nombre', 'primer_apellido', 'segundo_apellido', 'username', 'email', 'password' ]));
            });

            return $this->respondWithArray([ 'isValid' => true ]);
        } catch (\Throwable $e) {
            return $this->setException($e)->respondeWithErrorsException();
        }
    }

    protected function createPlantel(Subsistema $subsistema, array $data): Plantel
    {
        $plantel = new Plantel($data);
        $subsistema->planteles()->save($plantel);

        return $plantel;
    }

    protected function createDomicilio(Plantel $plantel, array $data)
    {
        $domicilio = new Domicilio($data);
        $domicilio->save();
        $plantel->domicilio()->associate($domicilio)->save();
    }

    protected function createResponsible(Plantel $plantel, array $data)
    {
        $user = User::createUser($data, [ 2 ]);
        $plantel->responsable()->associate($user)->save();
    }
}
