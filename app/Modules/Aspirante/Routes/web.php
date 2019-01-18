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

Route::view('/', 'aspirante.dashboard')
    ->middleware([ 'role:aspirante' ])->name('aspirantes.dashboard');

