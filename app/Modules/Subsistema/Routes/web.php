<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-20
 * Time: 00:12
 *
 * path: /subsistemas
 */

Route::middleware([ 'auth', 'role:subsistema', 'hasSubsistema' ])
    ->prefix('/')
    ->group(function () {
        Route::get('/{all?}', 'HomeController')
            ->where([ 'all' => '.*' ])
            ->name('spa.subsistemas');
    });
