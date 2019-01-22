<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-17
 * Time: 09:03
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Http\Requests\StoreAspiranteConMatricula;
use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;
use ExamenEducacionMedia\User;

class RegistroMatriculaController extends Controller
{

    public function index()
    {
        $paises  = Pais::selectPaises();
        $generos = [ 'H' => 'HOMBRE', 'M' => 'MUJER' ];

        return view('aspirante.registro_matricula', compact('paises', 'generos'));
    }

    public function store(StoreAspiranteConMatricula $request)
    {
        $request->validated();

        try {

            $user = DB::transaction(function () use ($request) {
                $user = User::createUser($request->input(), [ 'aspirante' ]);

                $folio = Folio::getFolio();

                $aspirante        = new Aspirante($request->input());
                $aspirante->folio = $folio->id;
                $folio->desactivar();

                $aspirante->user()->associate($user)->save();

                $this->guard()->login($user);

                return $user;
            });

            return ok(compact('user'));
        } catch (\Exception $e) {
            return not_acceptable([ $e->getMessage() ], [ $e->getMessage() ]);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

}
