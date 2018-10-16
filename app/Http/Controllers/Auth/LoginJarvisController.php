<?php

namespace ExamenEducacionMedia\Http\Controllers\Auth;

use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class LoginJarvisController extends Controller
{
    public function showLoginForm()
    {
        return view('auth_jarvis.login');
    }

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post(env('JARVIS_AUTH_URL_TOKEN'), [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => env('JARVIS_CLIENT_ID'),
                'client_secret' => env('JARVIS_SECRET'),
                'username'      => $request->input('username'),
                'password'      => $request->input('password'),
                'code'          => $request->code,
            ],
        ]);

        //session()->put('token', json_decode((string)$response->getBody(), true));

        $token = json_decode((string)$response->getBody(), true);

        //Con el token hacer la llamada a la url de jarvis que te devuelve el usaurio
        $user = $this->getJarvisUserInfo($token['access_token']);

        $this->authenticate(User::findOrCreateJarvisUser($user, $token));

        return redirect()->route('welcome');
    }

    public function authenticate(User $user)
    {
        \Auth::login($user, true);
    }

    protected function getJarvisUserInfo($accessToken)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept'        => 'application/json',
        ];
        $http    = new \GuzzleHttp\Client([ 'base_uri' => env('JARVIS_API_URL') ]);

        $response = $http->get('user', [
            'headers' => $headers,
        ]);

        $user = json_decode((string)$response->getBody(), true);

        return $user;
    }

    protected function validateLogin()
    {

    }
}
