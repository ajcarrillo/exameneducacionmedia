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

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id'     => '3',
        'redirect_uri'  => 'http://exameneducacionmedia.test/home',
        'response_type' => 'code',
        'scope'         => '',
    ]);

    return redirect('http://jarvis.test/oauth/authorize?' . $query);
});

Route::get('/home', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://jarvis.test/oauth/token', [
        'form_params' => [
            'grant_type'    => 'authorization_code',
            'client_id'     => '3',
            'client_secret' => 'GiDCqoJw2Nw6RkWs9NPjCEe7THASGs0ZhIEPQYFG',
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
            'client_id'     => '3',
            'client_secret' => 'GiDCqoJw2Nw6RkWs9NPjCEe7THASGs0ZhIEPQYFG',
            'username'      => 'mwhite',
            'password'      => 'secret',
            'code'          => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});
