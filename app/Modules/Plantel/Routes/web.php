<?php
/* url: /planteles */

Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->group(function () {
        Route::get('/', 'PanelController@index')->name('planteles.panel');
        Route::get('/aspirantes', 'BuscarAspirantesController@index')->name('planteles.aspirantes');
        Route::get('/reportes/{formato}', 'ReportesController@descargar')->name('planteles.reporte');
    });


