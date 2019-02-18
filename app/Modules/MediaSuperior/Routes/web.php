<?php
/**
 * Created by PhpStorm.
 * User: Igna
 */
Route::middleware([ 'auth', 'role:departamento' ])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {
        Route::prefix('/aspirantes')
            ->name('aspirantes.')
            ->group(function () {
                Route::get('/', 'AspiranteController@index')->name('index');
                Route::get('/show/{id}', 'AspiranteController@show')->name('show');
            });

        Route::prefix('/enlaces')
            ->name('enlaces.')
            ->group(function () {
                Route::get('/{enlace}/editar', 'EnlaceController@edit')->name('edit');
                Route::patch('/{enlace}', 'EnlaceController@update')->name('update');
                Route::get('/nuevo', 'EnlaceController@create')->name('create');
                Route::post('/', 'EnlaceController@store')->name('store');
                Route::get('/', 'EnlaceController@index')->name('index');
            });

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
                Route::get('/buscar', function () {
                    return redirect()->route('media.administracion.estudiante.index');
                });
            });

        Route::prefix('/sedes-alternas')
            ->name('sedesAlternas.')
            ->group(function () {
                Route::get('/', 'Administracion\SedeAlternaController@index')->name('index');
                Route::get('/create', 'Administracion\SedeAlternaController@create')->name('create');
                Route::post('/store', 'Administracion\SedeAlternaController@store')->name('store');
                Route::get('{sede}/edit', 'Administracion\SedeAlternaController@edit')->name('edit');
                Route::patch('{sede}/update', 'Administracion\SedeAlternaController@update')->name('update');
                Route::get('/localidades', 'Administracion\SedeAlternaController@localidades')->name('localidades');
                Route::get('{sede}/localidades', 'Administracion\SedeAlternaController@localidades')->name('localidades');
                Route::get('{sede}/aulas', 'Administracion\SedeAlternaController@aulas')->name('aulas');
            });

        Route::prefix('/aulas')
            ->name('aulas.')
            ->group(function () {
                Route::get('{sede}/create', 'Administracion\AulaController@create')->name('create');
                Route::post('/store', 'Administracion\AulaController@store')->name('store');
                Route::get('{aula}/destroy', 'Administracion\AulaController@destroy')->name('delete');
            });

        Route::prefix('/responsablePlantel')
            ->name('responsablePlantel.')
            ->group(function () {
                Route::get('/', 'Administracion\ResponsablePlantelController@index')->name('index');
                Route::get('/edit/{plantel}', 'Administracion\ResponsablePlantelController@edit')->name('plantel.edit');
                Route::post('/usuario_existente/{plantel}', 'Administracion\ResponsablePlantelController@asigna_responsable_existente')->name('usr.plantel');
                Route::post('/store{plantel}', 'Administracion\ResponsablePlantelController@store')->name('plantel.store');
                Route::get('/descuentos/{Plantel}', 'Administracion\ResponsablePlantelController@descuentos')->name('plantel.descuentos');
                Route::post('/update/{id}', 'Administracion\ResponsablePlantelController@updatedesc')->name('plantel.descuentosupd');
                Route::get('/delete/{plantel}', 'Administracion\ResponsablePlantelController@delete_responsable')->name('plantel.delete_responsable');
            });

        Route::prefix('/carga-documentos')
            ->name('carga-documentos.')
            ->group(function () {
                Route::get('/', 'Administracion\CargaDocumentosController@index')->name('index');
                Route::get('/create', 'Administracion\CargaDocumentosController@create')->name('create');
                Route::post('/store', 'Administracion\CargaDocumentosController@store')->name('store');
                Route::get('/descargar/{id}', 'Administracion\CargaDocumentosController@descargar')->name('descargar');
                Route::get('/eliminar/{archivo}', 'Administracion\CargaDocumentosController@eliminar')->name('eliminar');
            });

        Route::prefix('/usuarios')
            ->name('usuarios.')
            ->group(function () {
                Route::get('/', 'UserController')->name('index');
            });


        // INICIO RUTAS abalamjimenez@gmail.com
        Route::prefix('/responsableSubsistema')
            ->name('responsableSubsistema.')
            ->group(function () {
                Route::get('/', 'Administracion\ResponsableSubsistemaController@index')->name('index');
                Route::get('/edit/{subsistema}', 'Administracion\ResponsableSubsistemaController@edit')->name('subsistema.edit');
                Route::post('/usuario_existente/{subsistema}', 'Administracion\ResponsableSubsistemaController@asigna_responsable_existente')->name('usr.subsistema');
                Route::post('/store{subsistema}', 'Administracion\ResponsableSubsistemaController@store')->name('subsistema.store');
                Route::get('/delete/{subsistema}', 'Administracion\ResponsableSubsistemaController@delete_responsable')->name('subsistema.delete_responsable');
            });
        // FIN RUTAS abalamjimenez@gmail.com

        Route::prefix('/revisiones')
            ->name('revisiones.')
            ->group(function () {
                Route::prefix('/ofertaEducativa')
                    ->name('ofertaEducativa.')
                    ->group(function () {
                        Route::get('/', 'Administracion\Revisiones\OfertaEducativaController@index')->name('index');
                        Route::get('/oferta', 'Administracion\Revisiones\OfertaEducativaController@oferta')->name('oferta');
                        Route::get('/guardarComentario', 'Administracion\Revisiones\OfertaEducativaController@guardarComentario')->name('guardarComentario');
                        Route::get('/imprimir', 'Administracion\Revisiones\OfertaEducativaController@imprimir')->name('imprimir');
                    });

                Route::prefix('/aforo')
                    ->name('aforo.')
                    ->group(function () {
                        Route::get('/', 'Administracion\Revisiones\AforoController@index')->name('index');
                        Route::get('/aforo', 'Administracion\Revisiones\AforoController@aforo')->name('aforo');
                        Route::get('/guardarComentario', 'Administracion\Revisiones\AforoController@guardarComentario')->name('guardarComentario');
                        Route::get('/imprimir', 'Administracion\Revisiones\AforoController@imprimir')->name('imprimir');
                    });
            });

        Route::prefix('/configuracion')
            ->name('configuracion.')
            ->group(function () {
                Route::get('/', 'Administracion\ConfiguracionController@index')->name('index');
                Route::post('/update', 'Administracion\ConfiguracionController@update')->name('update');
            });

        //Ruta-Rosa
        Route::prefix('/panelAdministracion')
            ->name('panelAdministracion.')
            ->group(function () {
                Route::get('/', 'PanelController@index')->name('index');
            });
        //end

    });

Route::middleware(['auth', 'role:plantel|departamento'])
    ->prefix('/administracion')
    ->name('administracion.')
    ->group(function () {
        Route::get('/problemas-curp', 'Administracion\ProblemaCurpController@index')->name('historico.curp');
        Route::get('/problemas-curp/descargar', 'Administracion\ProblemaCurpController@descargar')->name('historico.descargar');
    });