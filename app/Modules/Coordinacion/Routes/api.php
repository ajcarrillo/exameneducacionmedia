<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-03
 * Time: 23:51
 *
 * path: api/coordinacion
 *
 */


Route::prefix('/pagos')
    ->name('api.pagos.')
    ->middleware([ 'auth:api' ])
    ->group(function () {
        Route::get('/pagos', 'PagosController@index')->name('')->name('index');
    });
