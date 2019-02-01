<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-31
 * Time: 17:20
 */

namespace ExamenEducacionMedia\Traits;


use Auth;
use ExamenEducacionMedia\User;

trait LoginAsUser
{
    protected $sessionKey = 'imporsonate.original_id';

    public function getOriginalUser()
    {
        if ( ! $this->hasImpersonated()) {
            return Auth::user();
        }

        $userId = session()->get($this->sessionKey);

        return User::where('id', $userId)->first();
    }

    public function hasImpersonated()
    {
        return session()->has('imporsonate.has_impersonated');
    }
}
