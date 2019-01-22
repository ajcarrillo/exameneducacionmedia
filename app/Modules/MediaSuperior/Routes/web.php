<?php
/**
 * Created by PhpStorm.
 * User: Igna
 */
Route::middleware([ 'auth' ])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {
        Route::prefix('/etapasProceso')
            ->name('etapasProceso.')
            ->group(function () {
                Route::get('/', 'Administracion\EtapaController@index')->name('index');
                Route::get('/edit', 'Administracion\EtapaController@edit')->name('edit');
                Route::post('/update', 'Administracion\EtapaController@update')->name('update');
            });
    });