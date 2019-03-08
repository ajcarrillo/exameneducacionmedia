<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:49
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Http\Requests\StoreUser;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio;
use ExamenEducacionMedia\User;

class RegistroExternoController extends Controller
{
    public function index()
    {
        $paises  = Pais::selectPaises();
        $generos = [ 'H' => 'HOMBRE', 'M' => 'MUJER' ];

        return view('aspirante.registro_externo', compact('paises', 'generos'));
    }

    public function store(StoreUser $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $user = User::createUser($request->input(), [ 'aspirante' ]);

                $folio = Folio::getFolio();

                $aspirante        = new Aspirante($request->only('fecha_nacimiento'));
                $aspirante->folio = $folio->folio;
                $folio->desactivar();

                $aspirante->user()->associate($user)->save();

                $this->guard()->login($user);
            });

            return redirect('/aspirantes');
        } catch (\Throwable $e) {
            abort(422, 'Lo sentimos ha ocurrido un error, intenta de nuevo');
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
