<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 11:14
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Http\Requests\StoreRevisionRegistro;
use DB;
use ExamenEducacionMedia\Classes\SolicitudPago;
use ExamenEducacionMedia\Http\Controllers\Controller;

class EnviarRegistroController extends Controller
{
    public function store(StoreRevisionRegistro $request)
    {
        $request->validated();

        try {
            DB::transaction(function () {
                $aspirante = get_aspirante();

                $solicitud = new SolicitudPago($aspirante);

                try {
                    $id = $solicitud->enviar()->solicitudPagoId;
                    $aspirante->crearRevision($id);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage(), $e->getCode());
                }

                $revisionRegistro = $aspirante->revision;

                $revisionRegistro->crearRevision();
            });

            flash('Tu registro se envió correctamente')->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }

        return back();
    }
}
