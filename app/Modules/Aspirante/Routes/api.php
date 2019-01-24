<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 23:01
 *
 * path: api/aspirantes
 *
 */


Route::middleware([ 'auth:api', 'role:aspirante' ])
    ->name('aspirante.')
    ->group(function () {
        Route::patch('/{id}', 'API\UpdateAspiranteController@update')->name('update');
    });

