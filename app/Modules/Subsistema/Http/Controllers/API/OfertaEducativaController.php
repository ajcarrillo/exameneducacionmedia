<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 13:00
 */

namespace Subsistema\Http\Controllers\API;

use DB;
use ExamenEducacionMedia\Models\EtapaProceso;
use ExamenEducacionMedia\Traits\ResponseTrait;
use Illuminate\Http\Request;
use MediaSuperior\Models\Revision;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
use Subsistema\Models\RevisionOferta;

class OfertaEducativaController extends BaseController
{
    use ResponseTrait;

    public function index($uuid)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($uuid);
        $plantel->loadMissing(
            'ofertaEducativa',
            'ofertaEducativa.especialidad:id,referencia,descripcion',
            'ofertaEducativa.programaEstudio:id,descripcion',
            'ofertaEducativa.grupos'
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
                    'plantel_id',
                    'especialidad_id',
                    'programa_estudio_id',
                    'clave'
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

    protected function existsOferta(Plantel $plantel, $especialidadId)
    {
        if ($plantel->ofertaEducativa()->where('especialidad_id', $especialidadId)->exists()) {
            throw new \Exception('La especialidad ya existe en el plantel');
        };
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

    public function storeRevision(Request $request)
    {
        try {
            DB::beginTransaction();

            $this->setSubsistema();
            $revision       = new RevisionOferta();
            $revisionOferta = $this->subsistema->revisiones()->save($revision);

            if (! $revisionOferta) {
                throw new \Exception('Error al intentar guardar la revisión');
            }

            $review = new Revision([
                'revision_type'    => 'ofertas',
                'revision_id'      => $revisionOferta->id,
                'estado'           => 'R',
                'usuario_apertura' => \Auth::guard('api')->user()->id,
                'fecha_apertura'   => now(),
            ]);

            if (! $revisionOferta->review()->save($review)) {
                throw new \Exception('Error al intentar guardar la revisión');
            }

            $subsistema = $this->subsistema->loadMissing(
                [
                    'planteles',
                    'planteles.responsable',
                    'planteles.municipio',
                    'planteles.localidad',
                    'especialidades',
                    'planteles.aulas',
                    'planteles.ofertaEducativa.grupos',
                    'revisionAforos'  => function ($query) {
                        return $query->orderBy('id', 'desc')->first();
                    },
                    'revisionAforos.review',
                    'revisiones' => function ($query) {
                        return $query->orderBy('id', 'desc')->first();
                    },
                    'revisiones.review',
                ]
            );

            $isAforo = EtapaProceso::isAforo();
            $isOferta = EtapaProceso::isOferta();
            $estado  = is_null($this->subsistema->revisionAforos->first()) ? 'sr' : $this->subsistema->revisionAforos->first()->review->estado;

            $reviewOferta = $subsistema->revisiones->first();
            $ofertaEstado   = is_null($reviewOferta) ? 'sr' : $reviewOferta->review->estado;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return error_json_response($e->getMessage(), [], 500);
        }

        return $this->respondWithArray(compact('subsistema', 'isAforo', 'estado', 'isOferta', 'ofertaEstado'));
    }
}
