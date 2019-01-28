<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-17
 * Time: 17:15
 */

namespace Aspirante\Http\Controllers;

use ExamenEducacionMedia\Http\Controllers\Controller;
use GuzzleHttp\Client;


class BuscarMatriculaController extends Controller
{

    public function index()
    {
        $guzzle = new Client;

        $response = $guzzle->post(env('JARVIS_AUTH_URL_TOKEN'), [
            'form_params' => [
                'grant_type'    => 'client_credentials',
                'client_id'     => env('JARVIS_CLIENT_ID'),
                'client_secret' => env('JARVIS_SECRET'),
                'scope'         => '',
            ],
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . json_decode((string)$response->getBody(), true)['access_token'],
            'Accept'        => 'application/json',
        ];

        $http = new Client([ 'base_uri' => env('JARVIS_API_URL') ]);

        $response = $http->get('estudiantes/buscar/matricula', [
            'headers' => $headers,
            'query'   => [ 'matricula' => request('matricula') ],
        ]);

        $alumno = json_decode((string)$response->getBody(), true);

        return ok(compact('alumno'));
    }

}
