<?php

namespace ExamenEducacionMedia\Http\Controllers\Plantel;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('planteles.home');
    }
}
