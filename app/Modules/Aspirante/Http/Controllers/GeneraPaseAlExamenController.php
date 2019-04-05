<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 23:55
 */

namespace Aspirante\Http\Controllers;


use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;

class GeneraPaseAlExamenController extends Controller
{
    public function store()
    {
        try {
            throw new \Exception('Por el momento no se puede generar tu pase al examen');
            DB::transaction(function () {
                $aspirante = get_aspirante();

                return $aspirante->asignarPase();
            });
            flash('Tu pase al examen se generó correctamente')->success();
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
            \Log::info($e->getTraceAsString());
            flash($e->getMessage())->error();
        }

        return back();
    }
}
