<?php
/* url: /planteles */

Route::middleware([ 'auth', 'role:plantel|subsistema' ])
    ->group(function () {
        Route::get('/', 'PanelController@index')->name('planteles.panel');
        Route::get('/aspirantes', 'BuscarAspirantesController@index')->name('planteles.aspirantes');
        Route::patch('/aspirantes/actualizar-contrasena/{uuid}', 'UpdateAspirantePassword@update')->name('planteles.aspirantes.actualizar.pass');
        Route::get('/aspirantes/actualizar-contrasena/{uuid}', 'UpdateAspirantePassword@index')->name('planteles.aspirantes.show.form');
        Route::get('/reportes/{formato}', 'ReportesController@descargar')->name('planteles.reporte');
    });


