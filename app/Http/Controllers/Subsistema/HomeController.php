<?php

namespace ExamenEducacionMedia\Http\Controllers\Subsistema;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $subsistema = \Auth::user()->subsistema->referencia;
        return view('subsistemas.home', compact('subsistema'));
    }
}
