<?php
/**
 * Created by PhpStorm.
 * User: geremias
 * Date: 6/02/19
 * Time: 09:57 AM
 */

Route::group([ 'prefix' => 'configuracion' ], function () {

    Route::get('/', [
        'uses' => 'ConfiguracionController@index',
        'as'   => 'configuracion.index',
    ]);

    Route::post('edit', [
        'uses' => 'ConfiguracionController@update',
        'as'   => 'configuracion.update',
    ]);
});