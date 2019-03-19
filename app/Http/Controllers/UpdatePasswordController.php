<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-18
 * Time: 19:14
 */

namespace ExamenEducacionMedia\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function update(Request $request)
    {
        $user           = \Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $this->guard()->login($user);

        return back();
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
