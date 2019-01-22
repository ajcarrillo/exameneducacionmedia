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
            });

        Route::prefix('/revisiones')
            ->name('revisiones.')
            ->group(function (){
                Route::prefix('/ofertaEducativa')
                    ->name('ofertaEducativa.')
                    ->group(function (){
                        Route::get('/','Administracion\Revisiones\OfertaEducativaController@index')->name('index');
                    });
            });
    });