<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-03
 * Time: 23:50
 *
 * path: /coordinacion
 *
 */

Route::get('/', 'PanelControlController')
    ->middleware([ 'auth', 'role:cordinador|departamento|supermario' ]);
