<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-14
 * Time: 21:58
 */

namespace Subsistema\Http\Controllers\API;

class ActivarOfertaEducativaController extends BaseController
{
    public function store($plantel)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $oferta = $plantel->ofertaEducativa()->findOrFail(request('oferta_id'));

        $oferta->activar();

        return ok();
    }

    public function destroy($plantel, $ofertaId)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $oferta = $plantel->ofertaEducativa()->findOrFail($ofertaId);

        $oferta->desactivar();

        return ok();
    }
}
