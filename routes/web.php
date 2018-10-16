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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/login-seq', function () {
    $query = http_build_query([
        'client_id'     => env('JARVIS_CLIENT_ID'),
        'redirect_uri'  => 'http://exameneducacionmedia.test/home',
        'response_type' => 'code',
        'scope'         => '',
    ]);

    return redirect('http://jarvis.test/oauth/authorize?' . $query);
})->name('login.seq');

Route::get('/home', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://jarvis.test/oauth/token', [
        'form_params' => [
            'grant_type'    => 'authorization_code',
            'client_id'     => env('JARVIS_CLIENT_ID'),
            'client_secret' => env('JARVIS_SECRET'),
            'redirect_uri'  => 'http://exameneducacionmedia.test/home',
            'code'          => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/vuetify', function () {
    return view('vuetify');
});
