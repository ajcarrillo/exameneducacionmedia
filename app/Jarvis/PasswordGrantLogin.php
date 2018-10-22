<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 22/10/18
 * Time: 11:40
 */

namespace ExamenEducacionMedia\Jarvis;


use Illuminate\Http\Request;

class PasswordGrantLogin extends Jarvis implements LoginJarvisInterface
{

    private $config;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config  = config('services.jarvis');
    }

    public function getUserToken()
    {
        if (is_null($this->config['client_secret'])) {
            throw new \Exception('Missing jarvis configuration');
        }

        $http = new \GuzzleHttp\Client;

        $response = $http->post($this->config['jarvis_auth_url_token'], [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => env('JARVIS_PASS_CLIENT_ID'),
                'client_secret' => env('JARVIS_PASS_SECRET'),
                'username'      => $this->request->input('email'),
                'password'      => $this->request->input('password'),
                'scope'         => [], //todres: Según el rol del usuario deberá ser el scope que se pida
            ],
        ]);

        $this->setToken(json_decode((string)$response->getBody(), true));

        return $this;
    }
}
