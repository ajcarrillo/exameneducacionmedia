<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-20
 * Time: 00:12
 *
 * path: api/subsistemas
 */

Route::resource('especialidades', 'API\EspecialidadController')
    ->parameter('especialidades', 'especialidad')
    ->only([ 'index', 'show', 'store', 'update', 'destroy' ])
    ->names([
        'index'   => 'api.subsistema.especialidades.index',
        'store'   => 'api.subsistema.especialidades.store',
        'update'  => 'api.subsistema.especialidades.update',
        'destroy' => 'api.subsistema.especialidades.destroy',
    ]);

Route::group([
    'prefix' => '/planteles',
], function () {
    Route::patch('/{plantel}/activar', 'API\ActivarPlantel@update')->name('api.plantel.activar');
    Route::patch('/{plantel}/actulizar-nombre', 'API\ActualizaNombrePlantelController@update')->name('api.plantel.actulizar.nombre');
    Route::delete('/{plantel}/desactivar', 'API\ActivarPlantel@destroy')->name('api.plantel.desactivar');
    Route::post('/{plantel}/domicilio', 'API\PlantelDomicilioController@store')->name('api.plantel.domicilio.store');
    Route::patch('/{plantel}/domicilio', 'API\PlantelDomicilioController@update')->name('api.plantel.domicilio.store');
    Route::post('/{plantel}/responsable', 'API\PlantelResponsableController@store')->name('api.plantel.responsable');
    Route::patch('/{plantel}', 'API\SubsistemaPlantelController@update')->name('api.subsistema.plantel.update');
    Route::post('/', 'API\SubsistemaPlantelController@store')->name('api.subsistema.plantel.store');
});

Route::resource('subsistemas', 'API\SubsistemaController')
    ->parameter('subsistemas', 'subsistema')
    ->only([ 'show' ])
    ->names([
        'show' => 'api.subsistemas.show',
    ]);
