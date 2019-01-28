<?php
/**
 * Created by PhpStorm.
 * User: Igna
 */
Route::middleware([ 'auth' ])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {
        Route::prefix('/etapas-proceso')
            ->name('etapasProceso.')
            ->group(function () {
                Route::get('/', 'Administracion\EtapaController@index')->name('index');
                Route::get('/edit', 'Administracion\EtapaController@edit')->name('edit');
                Route::post('/update', 'Administracion\EtapaController@update')->name('update');
            });

        Route::prefix('/estudiante')
            ->name('estudiante.')
            ->group(function () {
                Route::get('/', 'Administracion\BuscarMatriculaController@index')->name('index');
                Route::post('/buscar', 'Administracion\BuscarMatriculaController@buscarEstudiante')->name('buscar');
            });
    });