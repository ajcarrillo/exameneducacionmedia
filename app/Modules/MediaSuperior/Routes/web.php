<?php
/**
 * Created by PhpStorm.
 * User: Igna
 */
Route::middleware([ 'auth', 'role:departamento' ])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {

        //-- Rutas Marlon
        Route::prefix('/enlaces')
            ->name('enlaces.')
            ->group(function () {
                Route::get('/{enlace}/editar', 'EnlaceController@edit')->name('edit');
                Route::patch('/{enlace}', 'EnlaceController@update')->name('update');
                Route::get('/nuevo', 'EnlaceController@create')->name('create');
                Route::post('/', 'EnlaceController@store')->name('store');
                Route::get('/', 'EnlaceController@index')->name('index');
            });
        //-- end Marlon

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
                Route::get('/buscar', function() {
                    return redirect()->route('media.administracion.estudiante.index');
                });
            });

        Route::prefix('/sedes-alternas')
            ->name('sedesAlternas.')
            ->group(function () {
                Route::get('/', 'Administracion\SedeAlternaController@index')->name('index');
                Route::get('/create', 'Administracion\SedeAlternaController@create')->name('create');
                Route::post('/store', 'Administracion\SedeAlternaController@store')->name('store');
                //Route::get('/edit', 'Administracion\EtapaController@edit')->name('edit');
                //Route::post('/update', 'Administracion\EtapaController@update')->name('update');
            });

        Route::prefix('/responsablePlantel')
            ->name('responsablePlantel.')
            ->group(function () {
                Route::get('/', 'Administracion\ResponsablePlantelController@index')->name('index');
                Route::get('/edit/{plantel}','Administracion\ResponsablePlantelController@edit')->name('plantel.edit');
                Route::post('/store{plantel}','Administracion\ResponsablePlantelController@store')->name('plantel.store');
                Route::get('/edit/{Plantel}','Administracion\ResponsablePlantelController@edit')->name('plantel.edit');
                Route::get('/actualiza-responsable/{plantel}','Administracion\ResponsablePlantelController@Actualiza_responsable')->name('plantel.Actualiza_responsable ');
                Route::post('/set_responsable/{plantel}','Administracion\ResponsablePlantelController@set_responsable')->name('plantel.set_responsable');
                Route::get('/delete/{plantel}','Administracion\ResponsablePlantelController@delete_responsable')->name('plantel.delete_responsable');
                Route::get('/descuentos/{Plantel}','Administracion\ResponsablePlantelController@descuentos')->name('plantel.descuentos');
                Route::post('/update/{id}','Administracion\ResponsablePlantelController@updatedesc')->name('plantel.descuentosupd');
            });
    });

