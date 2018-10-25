<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::view('/home', 'home')->middleware([ 'auth' ]);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/registro', function () {
    return view('welcome');
})->middleware([ 'isRegistro' ]);

Route::get('/subsistema/aforo', function () {
    return view('welcome');
})->middleware([ 'isAforo' ]);

Route::get('/subsistema/oferta', function () {
    return view('welcome');
})->middleware([ 'isOferta' ]);

Route::group([ 'prefix' => '/planteles', 'middleware' => [ 'auth', 'role:plantel', 'hasPlantel' ] ], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware([ 'auth', 'role:plantel', 'hasPlantel' ])
    ->prefix('/planteles')
    ->group(function () {
        Route::get('/{all?}', 'Plantel\HomeController@index')
            ->where([ 'all' => '.*' ])
            ->name('spa.planteles');
    });

Route::middleware([ 'auth', 'role:subsistema', 'hasSubsistema' ])
    ->prefix('/subsistemas')
    ->group(function () {
        Route::get('/{all?}', 'Subsistema\HomeController@index')
            ->where([ 'all' => '.*' ])
            ->name('spa.subsistemas');
    });

/* Login con jarvis*/
Route::get('/loging/oauth', 'Auth\LoginController@redirectToProvider')->name('login.oauth');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('login.oauth.callback');

Route::get('login/oauth-password', 'Auth\LoginJarvisController@showLoginForm')->name('login.jarvis');
Route::post('login/oauth-password', 'Auth\LoginJarvisController@login')->name('login.jarvis');
/*Login con jarvis*/

Auth::routes();
