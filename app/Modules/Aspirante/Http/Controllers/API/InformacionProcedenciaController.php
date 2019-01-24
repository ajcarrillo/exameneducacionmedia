<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 21:37
 */

namespace Aspirante\Http\Controllers\API;


use Aspirante\Http\Requests\StoreInformacionProcedencia;
use Aspirante\Models\Aspirante;
use Aspirante\Models\InformacionProcedencia;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;

class InformacionProcedenciaController extends Controller
{
    public function store(StoreInformacionProcedencia $request, Aspirante $aspirante)
    {
        $request->validated();

        try {
            $informacion = DB::transaction(function () use ($request, $aspirante) {
                $informacion = new InformacionProcedencia($request->input());

                $informacion->save();

                $aspirante->informacionProcedencia()->associate($informacion)->save();

                return $informacion;
            });

            return ok(compact('informacion'));
        } catch (\Throwable $e) {
            return unprocessable_entity(
                [ $e->getMessage(), $e->getTraceAsString() ],
                [ $e->getMessage() ]
            );
        }
    }

    public function update(StoreInformacionProcedencia $request, $id)
    {
        $request->validated();

        $aspirante = get_aspirante();

        $informacion = $aspirante->informacionProcedencia()->findOrFail($id);

        $informacion->update($request->input());

        return ok();
    }
}
