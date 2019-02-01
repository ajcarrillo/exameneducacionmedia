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

Route::get('/registro-externo', 'RegistroExternoController@index')->name('registro.externo');
Route::post('/registro-externo', 'RegistroExternoController@store')->name('registro.externo');

Route::get('/registro-matricula', 'RegistroMatriculaController@index')->name('registro.matricula');
Route::post('/registro-matricula', 'RegistroMatriculaController@store')->name('registro.matricula');

Route::middleware(['auth', 'role:aspirante'])
    ->name('aspirante.profile')
    ->get('/datos-generales', 'ProfileController');

/*Route::view('/', 'aspirante.dashboard')
    ->middleware([ 'auth', 'role:aspirante' ])
    ->name('aspirantes.dashboard');
*/
Route::middleware([ 'auth', 'role:aspirante' ])
    ->prefix('/')
    ->name('aspirantes.dashboard')
    ->group(function () {
        //Route::view('/', 'aspirante.dashboard');
        Route::prefix('/')
            ->name('enlaces.')
            ->group(function () {

                Route::get('/', 'ProfileController@index')->name('index');
            });
    });
