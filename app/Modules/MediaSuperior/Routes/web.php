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

        Route::prefix('/revisiones')
            ->name('revisiones.')
            ->group(function (){
                Route::prefix('/ofertaEducativa')
                    ->name('ofertaEducativa.')
                    ->group(function (){
                        Route::get('/','Administracion\Revisiones\OfertaEducativaController@index')->name('index');
                        Route::get('/oferta','Administracion\Revisiones\OfertaEducativaController@oferta')->name('oferta');
                        Route::get('/guardarComentario','Administracion\Revisiones\OfertaEducativaController@guardarComentario')->name('guardarComentario');
                    });
            });
    });