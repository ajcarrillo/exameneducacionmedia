<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-06
 * Time: 11:05
 */

namespace Aspirante\Http\Controllers\API;


use Aspirante\Models\Seleccion;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Subsistema\Models\OfertaEducativa;

class SeleccionOfertaController extends Controller
{
    public function index()
    {
        $seleccion = $this->getSeleccionPrevia();

        return ok(compact('seleccion'));
    }

    public function store(Request $request)
    {
        $aspirante = get_aspirante();

        try {
            DB::transaction(function () use ($request, $aspirante) {
                $aspirante->opcionesEducativas()->delete();
                foreach ($request->input('seleccion') as $opcion) {
                    $nuevaOpcion = new Seleccion([
                        'preferencia'         => $opcion['preferencia'],
                        'aspirante_id'        => $aspirante->id,
                        'oferta_educativa_id' => $opcion['id'],
                    ]);

                    $nuevaOpcion->save();
                }
            });

            return ok();
        } catch (\Throwable $e) {
            return unprocessable_entity([
                $e->getMessage(), $e->getTraceAsString(),
            ], [
                $e->getMessage(),
            ]);
        }
    }

    protected function getSeleccionPrevia()
    {
        $aspirante = get_aspirante();

        $query = OfertaEducativa::with('plantel', 'especialidad');

        return $query->join('seleccion_ofertas_educativas as soe', function ($join) {
            $join->on('ofertas_educativas.id', '=', 'soe.oferta_educativa_id');
        })->where('soe.aspirante_id', $aspirante->id)
            ->get();
    }
}
