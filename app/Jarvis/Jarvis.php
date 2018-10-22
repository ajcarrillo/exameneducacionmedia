<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 22/10/18
 * Time: 11:48
 */

namespace ExamenEducacionMedia\Jarvis;


class Jarvis
{
    public $user  = NULL;
    public $token = NULL;

    public static function login($type, $request)
    {
        if ($type == 'authorization') {
            return new AuthorizationGrantLogin($request);
        }

        return new PasswordGrantLogin($request);
    }

    public function getUser()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token['access_token'],
            'Accept'        => 'application/json',
        ];

        $http = new \GuzzleHttp\Client([ 'base_uri' => config('services.jarvis.jarvis_api_url') ]);

        $response = $http->get('user', [
            'headers' => $headers,
        ]);

        $this->setUser(json_decode((string)$response->getBody(), true));

        return $this;
    }

    protected function setToken($token)
    {
        $this->token = $token;
    }

    protected function setUser($user)
    {
        $this->user = $user;
    }
}
