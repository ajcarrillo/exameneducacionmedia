<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:16
 */

namespace Subsistema\Http\Controllers\API;


use Illuminate\Http\Request;
use Subsistema\Models\Aula;

class AforoController extends BaseController
{
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
}
