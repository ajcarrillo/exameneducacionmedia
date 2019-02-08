<?php

Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->group(function () {
        Route::get('/', 'PanelController@index')->name('planteles.panel');
    });




/*Route::get('/panel', 'PanelController@index')->name('panel');

Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->prefix('/')
    ->group(function () {
        Route::get('/{all?}', 'PanelController')
            ->where([ 'all' => '.*' ])
            ->name('panel');
    });*/
