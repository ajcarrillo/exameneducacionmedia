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

                $revisionRegistro = new RevisionRegistro([
                    'efectuado' => false,
                ]);

                $revisionRegistro->aspirante()->associate($aspirante)->save();

                $revision = new Revision([
                    'fecha_apertura'   => Carbon::now(),
                    'estado'           => 'R',
                    'usuario_apertura' => get_aspirante()->id,
                ]);

                $revision->revision()->associate($revisionRegistro)->save();
            });

            flash('Tu registro se envió correctamente')->success();
        } catch (\Throwable $e) {
            flash('Lo sentimos ha ocurrido un error intenta de nuevo')->error();
        }

        return back();
    }
}
