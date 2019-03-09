<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-14
 * Time: 23:48
 */

namespace Subsistema\Http\Controllers\API;


class OfertaEducativaGrupoController extends BaseController
{
    public function store($plantel, $ofertaId)
    {
        $this->setSubsistema();
        $plantel = $this->getPlantel($plantel);

        $oferta = $plantel->ofertaEducativa()->findOrFail($ofertaId);

        $oferta->grupos()->updateOrCreate(
            [ 'oferta_educativa_id' => $ofertaId ],
            [ 'grupos' => request('grupos'), 'alumnos' => request('alumnos') ]
        );
        $oferta->load('grupos');
        return ok(compact('oferta'));
    }
}
