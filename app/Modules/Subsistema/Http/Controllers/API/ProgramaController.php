<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-13
 * Time: 23:00
 */

namespace Subsistema\Http\Controllers\API;


use Subsistema\Models\ProgramaEstudio;

class ProgramaController
{
    public function __invoke()
    {
        $programas = ProgramaEstudio::select('id', 'descripcion')
            ->get();

        return ok(compact('programas'));
    }
}
