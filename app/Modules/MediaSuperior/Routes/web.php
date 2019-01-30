<?php
/**
 * Created by PhpStorm.
 * User: Igna
 */
Route::middleware([ 'auth', 'role:departamento' ])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {

        Route::prefix('/enlaces')
            ->name('enlaces.')
            ->group(function () {
                Route::get('/{enlace}/editar', 'EnlaceController@edit')->name('edit');
                Route::patch('/{enlace}', 'EnlaceController@update')->name('update');
                Route::get('/nuevo', 'EnlaceController@create')->name('create');
                Route::post('/', 'EnlaceController@store')->name('store');
                Route::get('/', 'EnlaceController@index')->name('index');
            });

        Route::prefix('/etapasProceso')
            ->name('etapasProceso.')
            ->group(function () {
                Route::get('/', 'Administracion\EtapaController@index')->name('index');
                Route::get('/edit', 'Administracion\EtapaController@edit')->name('edit');
                Route::post('/update', 'Administracion\EtapaController@update')->name('update');
            });

        Route::prefix('/sedesAlternas')
            ->name('sedesAlternas.')
            ->group(function () {
                Route::get('/', 'Administracion\SedeAlternaController@index')->name('index');
                Route::get('/create', 'Administracion\SedeAlternaController@create')->name('create');
                Route::post('/store', 'Administracion\SedeAlternaController@store')->name('store');
                //Route::get('/edit', 'Administracion\EtapaController@edit')->name('edit');
                //Route::post('/update', 'Administracion\EtapaController@update')->name('update');
            });
    });
