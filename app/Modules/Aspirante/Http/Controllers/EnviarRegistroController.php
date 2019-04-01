<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 11:14
 */

namespace Aspirante\Http\Controllers;


use DB;
use ExamenEducacionMedia\Classes\SolicitudPago;
use ExamenEducacionMedia\Http\Controllers\Controller;

class EnviarRegistroController extends Controller
{
    public function store()
    {
        //$request->validated();
        $aspirante = get_aspirante();

        if ( ! $aspirante->paisNacimiento()->exists() || $aspirante->informacionProcedencia->fecha_egreso == NULL) {
            throw new \Exception('Verifica que tu información esté completa en la opción Editar Perfil');
        }

        try {
            $solicitudPagoId = DB::transaction(function () use ($aspirante) {


                $solicitud = new SolicitudPago($aspirante);

                try {
                    $id = $solicitud->enviar()->solicitudPagoId;
                    $aspirante->crearRevision($id);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage(), $e->getCode());
                }

                $revisionRegistro = $aspirante->revision;

                $revisionRegistro->crearRevision();

                return $id;
            });

            get_aspirante()->updateFichaJson($solicitudPagoId);

            flash('Tu registro se envió correctamente')->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }

        return back();
    }
}
