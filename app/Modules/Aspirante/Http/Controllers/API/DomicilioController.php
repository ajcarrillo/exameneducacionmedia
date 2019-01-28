<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-24
 * Time: 20:00
 */

namespace Aspirante\Http\Controllers\API;


use Aspirante\Http\Requests\StoreDomicilio;
use Aspirante\Models\Aspirante;
use Aspirante\Models\Domicilio;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;

class DomicilioController extends Controller
{

    public function store(StoreDomicilio $request, Aspirante $aspirante)
    {
        $request->validated();

        try {
            $domicilio = DB::transaction(function () use ($request, $aspirante) {
                $domicilio = new Domicilio($request->input());

                $domicilio->save();

                $aspirante->domicilio()->associate($domicilio)->save();

                return $domicilio;
            });

            return ok(compact('domicilio'));
        } catch (\Throwable $e) {
            return unprocessable_entity(
                [ $e->getMessage(), $e->getTraceAsString() ], [ $e->getMessage() ]
            );
        }
    }

    public function update(StoreDomicilio $request, Aspirante $aspirante, $id)
    {
        $request->validated();

        $domicilio = $aspirante->domicilio()->findOrFail($id);

        $domicilio->update($request->input());

        return $domicilio;
    }
}
