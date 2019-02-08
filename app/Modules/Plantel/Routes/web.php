<?php
//ruta-Rosa
Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->group(function () {
        Route::get('/', 'PanelController@index')->name('planteles.panel');
    });

//end ruta-Rosa
