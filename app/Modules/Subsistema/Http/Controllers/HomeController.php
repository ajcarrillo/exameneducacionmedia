<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-20
 * Time: 00:20
 */

namespace Subsistema\Http\Controllers;


class HomeController
{
    public function __invoke()
    {
        return view('subsistemas.home');
    }
}
