<?php

namespace Plantel\Http\Controllers;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        return view('planteles.home');

    }
}
