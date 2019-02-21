<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 11:14
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Http\Requests\StoreRevisionRegistro;
use Aspirante\Models\RevisionRegistro;
use Carbon\Carbon;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use MediaSuperior\Models\Revision;

class EnviarRegistroController extends Controller
{
    public function store(StoreRevisionRegistro $request)
    {
        $request->validated();

        try {
            DB::transaction(function () {
                $aspirante = get_aspirante();

                $aspirante->crearRevision();

                $revisionRegistro = $aspirante->revision;

                $revisionRegistro->crearRevision();
            });

            flash('Tu registro se envió correctamente')->success();
        } catch (\Throwable $e) {
            flash('Lo sentimos ha ocurrido un error intenta de nuevo')->error();
        }

        return back();
    }
}
