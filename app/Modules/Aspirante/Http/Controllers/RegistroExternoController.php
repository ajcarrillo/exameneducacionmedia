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
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Http\Requests\StoreUser;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
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

        $user = User::createUser($request->input(), [ 'aspirante' ]);

        $aspirante = new Aspirante($request->only('fecha_nacimiento'));

        $aspirante->user()->associate($user)->save();

        $this->guard()->login($user);

        return redirect('/aspirantes');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
