<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:49
 */

namespace Aspirante\Http\Controllers;


use Auth;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Http\Requests\StoreUser;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;

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

        $user = User::createUser($request->input(), [ 'alumno' ]);

        $this->guard()->login($user);

        return redirect('/home');
    }

    protected function checkEmail($email)
    {
        return User::whereEmail($email)->exists();
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
