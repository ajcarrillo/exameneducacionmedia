<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 22/10/18
 * Time: 11:42
 */

namespace ExamenEducacionMedia\Jarvis;

use Illuminate\Http\Request;

class AuthorizationGrantLogin extends Jarvis implements LoginJarvisInterface
{
    private $config;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config  = config('services.jarvis');
    }

    public static function getQuery()
    {
        return http_build_query([
            'client_id'     => env('JARVIS_CLIENT_ID'),
            'redirect_uri'  => 'http://exameneducacionmedia.test/callback',
            'response_type' => 'code',
            'scope'         => '',
        ]);
    }

    public function getUserToken()
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post(env('JARVIS_AUTH_URL_TOKEN'), [
            'form_params' => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->config['client_id'],
                'client_secret' => $this->config['client_secret'],
                'redirect_uri'  => 'http://exameneducacionmedia.test/callback',
                'code'          => $this->request->code,
            ],
        ]);

        $this->setToken(json_decode((string)$response->getBody(), true));

        return $this;
    }
}
