<?php

namespace MediaSuperior\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use GuzzleHttp\Client;

class BuscarMatriculaController extends Controller
{
    public function index()
    {
        $estudiantes = collect();
        return view('media_superior.administracion.buscar_matricula.index', compact('estudiantes'));
    }

    public function buscarEstudiante()
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

        $response = $http->get('estudiantes/buscar-estudiante', [
            'headers' => $headers,
            'query'   => [
                'nombreCompleto' => request('nombreCompleto'),
                'curp' => request('curp')
            ],
        ]);

        $estudiantes = json_decode((string)$response->getBody(), true);

        return view('media_superior.administracion.buscar_matricula.index', $estudiantes);
    }
}
