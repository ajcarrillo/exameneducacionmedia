<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 23:01
 *
 * path: /aspirantes
 */

Route::post('/buscar-matricula', 'BuscarMatriculaController@index')->name('buscar.matricula');

Route::get('/registro-externo', 'RegistroExternoController@index')
    ->name('registro.externo')
    ->middleware([ 'isRegistro', 'existsFolios' ]);

Route::post('/registro-externo', 'RegistroExternoController@store')
    ->name('registro.externo')
    ->middleware([ 'isRegistro', 'existsFolios' ]);

Route::get('/registro-matricula', 'RegistroMatriculaController@index')
    ->name('registro.matricula')
    ->middleware([ 'isRegistro', 'existsFolios' ]);

Route::post('/registro-matricula', 'RegistroMatriculaController@store')
    ->name('registro.matricula')
    ->middleware([ 'isRegistro', 'existsFolios' ]);

Route::middleware([ 'auth', 'role:aspirante' ])
    ->name('aspirante.profile')
    ->get('/datos-generales', 'ProfileController');

Route::middleware([ 'auth', 'role:aspirante' ])
    ->name('aspirantes.seleccion.oferta')
    ->get('/opciones-educativas', 'SeleccionOfertaController');

Route::middleware([ 'auth', 'role:aspirante' ])
    ->prefix('/')
    ->name('aspirante.')
    ->group(function () {

        Route::prefix('/')
            ->name('dashboard.')
            ->group(function () {
                Route::get('/', 'DashboardController@index')->name('index');
            });

        Route::post('/enviar-registro', 'EnviarRegistroController@store')
            ->name('enviar.registro');

        Route::post('/generar-pase', 'GeneraPaseAlExamenController@store')
            ->name('generar.pase');

        //-- Rutas Igna
        Route::get('/captura-cuestionario', 'CuestionarioController@index')->middleware('cuestionario')->name('captura.cuestionario');
        Route::post('/captura-cuestionario', 'CuestionarioController@store')->middleware('cuestionario')->name('guarda.cuestionario');
        Route::view('/aviso-aspirante', 'aspirante.cuestionario.aviso_aspirante')->name('aviso.aspirante');
        //-- End Igna
    });





