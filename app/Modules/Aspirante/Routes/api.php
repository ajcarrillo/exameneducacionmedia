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
        Route::prefix('/domicilio')
            ->name('domicilio.')
            ->group(function () {
                Route::post('/{aspirante}', 'API\DomicilioController@store')
                    ->name('store');
            });

        Route::prefix('/informacion-procedencia')
            ->name('informacion.')
            ->group(function () {
                Route::patch('/{id}', 'API\InformacionProcedenciaController@update')
                    ->name('update');
                Route::post('/{aspirante}', 'API\InformacionProcedenciaController@store')
                    ->name('store');
            });

        Route::patch('/{id}', 'API\UpdateAspiranteController@update')->name('update');
    });

