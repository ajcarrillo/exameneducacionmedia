<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-06
 * Time: 20:33
 */

namespace ExamenEducacionMedia\Traits;


use ExamenEducacionMedia\User;

trait RedirectTo
{
    protected $redirectTo = '/home';

    public function redirectTo(User $user)
    {
        if ($user->hasRole('departamento')) {
            return redirect()->intended($this->redirectTo);
        }

        if ($user->hasRole('aspirante')) {
            return redirect()->intended('/aspirantes');
        }

        if ($user->hasRole('subsistema')) {
            return redirect()->intended('/subsistemas');
        }

        if ($user->hasRole('plantel')) {
            return redirect()->intended('/planteles');
        }

        return redirect()->intended($this->redirectTo);
    }
}