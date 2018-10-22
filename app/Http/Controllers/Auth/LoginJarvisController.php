<?php

namespace ExamenEducacionMedia\Http\Controllers\Auth;

use ExamenEducacionMedia\Jarvis\Jarvis;
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
        $jarvis = Jarvis::login('password', $request)
            ->getUserToken()
            ->getUser();

        $this->authenticate(User::findOrCreateJarvisUser($jarvis->user, $jarvis->token));

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
