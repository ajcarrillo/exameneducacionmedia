<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 19:13
 */

namespace Plantel\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;

class UpdateAspirantePassword extends Controller
{
    public function index($uuid)
    {
        $user = $this->getUser($uuid);

        return view('planteles.buscar_aspirantes.update_password', compact('user'));
    }

    protected function getUser($uuid)
    {
        $user = User::whereUuid($uuid)->first();

        return $user;
    }

    public function update(Request $request, $uuid)
    {
        $this->validatePassword($request);

        $user = $this->getUser($uuid);

        $user->updatePassword($request->password);

        flash('La contraseña se actualizó correctamente')->success();

        return back();
    }

    protected function validatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ], $this->validationMessages());
    }

    protected function validationMessages()
    {
        return [
            'password.min'      => 'La contraseña debe contener al menos 6 caracteres',
            'password.required' => 'La contraseña es requerida',
        ];
    }
}
