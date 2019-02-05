<?php

Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->prefix('/plantel')
    ->group(function () {
        Route::get('/', 'PanelController@index')->name('panel');
    });
