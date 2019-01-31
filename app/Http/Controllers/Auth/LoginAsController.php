<?php

namespace ExamenEducacionMedia\Http\Controllers\Auth;

use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAsController extends Controller
{
    protected $sessionKey = 'imporsonate.original_id';

    public function loginAsUser(Request $request)
    {
        $originalUserId = $request->user()->id;
        $loginAsUserId  = 2;

        session()->put('imporsonate.has_impersonated', true);
        session()->put($this->sessionKey, $originalUserId);

        \Auth::loginUsingId($loginAsUserId);

        return back();
    }

    public function logout()
    {
        if ( ! $this->hasImpersonated()) {
            return back();
        }

        \Auth::logout();

        $originalUserId = session()->get($this->sessionKey);

        if ($originalUserId) {
            \Auth::loginUsingId($originalUserId);
        }

        session()->forget($this->sessionKey);
        session()->forget('imporsonate.has_impersonated');

        return back();
    }

    protected function hasImpersonated()
    {
        return session()->has('imporsonate.has_impersonated');
    }
}
