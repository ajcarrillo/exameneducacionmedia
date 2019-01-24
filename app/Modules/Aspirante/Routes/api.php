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
        Route::post('/informacion-procedencia/{aspirante}', 'API\InformacionProcedenciaController@store')->name('informacion.store');
        Route::patch('/{id}', 'API\UpdateAspiranteController@update')->name('update');
    });

