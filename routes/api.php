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

Route::middleware('auth:api')
    ->get('/me', function (Request $request) {
        $user        = $request->user();
        $accessToken = $user->jarvis_user_access_token;

        return ok(compact('user', 'accessToken'));
    })->name('me');

Route::prefix('/v1')
    ->group(function () {
        Route::prefix('/especialidades')
            ->name('especialidades.')
            ->group(function () {
                Route::get('/', 'API\EspecialidadController@index')->name('index');
            });

        Route::group([ 'prefix' => '/geodatabase' ], function () {
            Route::get('/localidad', 'API\LocalidadController@show')->name('api.localidad.show');
            Route::get('/localidades', 'API\LocalidadController@index')->name('api.localidad.index');
            Route::get('/localidades-con-plantel', 'API\SeleccionLocalidadController@index')->name('api.localidad.plantel.index');
            Route::get('/municipios', 'API\MunicipioController@index')->name('api.municipios.index');
        });

        Route::prefix('/planteles')
            ->name('planteles.')
            ->group(function () {
                Route::get('/', 'API\PlantelController@index')->name('index');
            });
    });
