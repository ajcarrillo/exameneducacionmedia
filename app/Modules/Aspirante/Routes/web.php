<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 23:01
 *
 * path: /aspirantes
 */

Route::get('/registro-externo', 'RegistroExternoController@index')->name('registro.externo');
Route::post('/registro-externo', 'RegistroExternoController@store')->name('registro.externo');


