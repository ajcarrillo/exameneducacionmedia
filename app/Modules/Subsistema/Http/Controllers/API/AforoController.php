<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:16
 */

namespace Subsistema\Http\Controllers\API;


use ExamenEducacionMedia\Models\EtapaProceso;
use ExamenEducacionMedia\Modules\Subsistema\Models\RevisionAforo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MediaSuperior\Models\Revision;
use Subsistema\Models\Aula;
use Subsistema\Models\Subsistema;
use ExamenEducacionMedia\Traits\ResponseTrait;

class AforoController extends BaseController
{
    use ResponseTrait;

    public function index($plantel)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $aulas = $plantel->aulas;

        return ok(compact('aulas'));
    }

    public function store(Request $request, $plantel)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $aula = new Aula($request->input());

        $plantel->aulas()->save($aula);

        return ok();
    }

    public function destroy($plantel, $aulaId)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        try {
            $plantel->aulas()->findOrFail($aulaId)->delete();

            return ok();
        } catch (\Exception $e) {
            return not_acceptable([
                $e->getTraceAsString(),
            ], [
                $e->getMessage(),
            ]);
        }
    }

    public function storeRevision(Request $request)
    {
        try {
            DB::beginTransaction();

            $this->setSubsistema();
            $revision = new RevisionAforo();
            $revisionAforo = $this->subsistema->revisionAforos()->save($revision);

            if (!$revisionAforo) {
                throw new \Exception('Error al intentar guardar la revisión');
            }

            $review = new Revision([
                'revision_type' => 'aforos',
                'revision_id'=>$revisionAforo->id,
                'estado'=>'R',
                'usuario_apertura'=>\Auth::guard('api')->user()->id,
                'fecha_apertura'=>now()
            ]);

            if (!$revisionAforo->review()->save($review)) {
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
                    'revisionAforos' => function ($query) {
                        return $query->orderBy('id', 'desc')->first();
                    },
                    'revisionAforos.review'
                ]
            );

            $isAforo = EtapaProceso::isAforo();
            $estado = is_null($this->subsistema->revisionAforos->first()) ? 'sr' : $this->subsistema->revisionAforos->first()->review->estado;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return error_json_response($e->getMessage(), [], 500);
        }

        return $this->respondWithArray(compact('subsistema', 'isAforo', 'estado'));
    }
}
