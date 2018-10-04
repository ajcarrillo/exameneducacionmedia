<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')
    ->group(function () {

        Route::group([ 'prefix' => '/geodatabase' ], function () {
            Route::get('/localidades', 'API\LocalidadController@index')->name('api.localidad.index');
            Route::get('/municipios', 'API\MunicipioController@index')->name('api.municipios.index');
        });

        Route::resource('subsistemas', 'API\SubsistemaController')
            ->parameter('subsistemas', 'subsistema')
            ->only([ 'show' ])
            ->names([
                'show' => 'api.subsistemas.show',
            ]);

        Route::post('/planteles/{plantel}/domicilio', 'API\PlantelDomicilioController@store')->name('api.plantel.domicilio.store');
        Route::patch('/planteles/{plantel}/domicilio', 'API\PlantelDomicilioController@update')->name('api.plantel.domicilio.store');
    });
