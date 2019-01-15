<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 13:00
 */

namespace Subsistema\Http\Controllers\API;


use DB;
use Illuminate\Http\Request;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;

class OfertaEducativaController extends BaseController
{

    public function index($uuid)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($uuid);
        $plantel->loadMissing(
            'ofertaEducativa', 'ofertaEducativa.especialidad:id,referencia,descripcion',
            'ofertaEducativa.programaEstudio:id,descripcion', 'ofertaEducativa.grupos'
        );

        return ok(compact('plantel'));
    }

    public function store(Request $request, $uuid)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($uuid);

        try {
            $oferta = DB::transaction(function () use ($request, $plantel) {

                $this->existsOferta($plantel, $request->input('especialidad_id'));

                $oferta = new OfertaEducativa($request->only(
                    'plantel_id', 'especialidad_id', 'programa_estudio_id', 'clave'
                ));

                $plantel->ofertaEducativa()->save($oferta);

                /*$poblacion = new Grupo($request->only(
                    'grupos', 'alumnos'
                ));

                $oferta->grupos()->save($poblacion);*/

                return $oferta;
            });

            $oferta->loadMissing('grupos');

            return ok(compact('oferta'));
        } catch (\Throwable $e) {
            return not_acceptable([
                $e->getTraceAsString(),
            ], [
                $e->getMessage(),
            ]);
        }
    }

    public function destroy($plantel, $ofertaId)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $oferta = $plantel->ofertaEducativa()->findOrFail($ofertaId);

        try {
            DB::transaction(function () use ($oferta) {
                $oferta->grupos()->delete();
                $oferta->delete();
            });

            return ok();
        } catch (\Throwable $e) {
            return not_acceptable($e->getTraceAsString(), $e->getMessage());
        }
    }

    protected function existsOferta(Plantel $plantel, $especialidadId)
    {
        if ($plantel->ofertaEducativa()->where('especialidad_id', $especialidadId)->exists()) {
            throw new \Exception('La especialidad ya existe en el plantel');
        };
    }
}
