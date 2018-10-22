<?php

namespace ExamenEducacionMedia\Http\Controllers\Auth;

use ExamenEducacionMedia\Jarvis\AuthorizationGrantLogin;
use ExamenEducacionMedia\Jarvis\Jarvis;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;

class LoginJarvisOatuhController extends Controller
{
    public function login()
    {
        $query = AuthorizationGrantLogin::getQuery();

        return redirect(config('services.jarvis.jarvis_auth_url') . $query);
    }

    public function callback(Request $request)
    {
        $jarvis = Jarvis::login('authorization', $request)
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
}
