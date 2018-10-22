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

Route::view('/home', 'home')->middleware(['auth']);

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
Route::get('/siie/oauth','Auth\LoginJarvisOatuhController@login' )->name('login.oauth');

Route::get('/callback', 'Auth\LoginJarvisOatuhController@callback');

Route::get('/password', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://jarvis.test/oauth/token', [
        'form_params' => [
            'grant_type'    => 'password',
            'client_id'     => env('JARVIS_CLIENT_ID'),
            'client_secret' => env('JARVIS_SECRET'),
            'username'      => 'ajcarrillo',
            'password'      => 'secret',
            'code'          => $request->code,
        ],
    ]);

    //session()->put('token', json_decode((string) $response->getBody(), true));

    return json_decode((string)$response->getBody(), true);
});
/*Login con jarvis*/

Route::get('login/jarvis', 'Auth\LoginJarvisController@showLoginForm')->name('login.jarvis');
Route::post('login/jarvis', 'Auth\LoginJarvisController@login')->name('login.jarvis');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/vuetify', function () {
    return view('vuetify');
});
