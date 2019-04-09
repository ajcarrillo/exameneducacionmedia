<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-08
 * Time: 19:59
 */

namespace Billy\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BuscarReferenciaController extends Controller
{
    public function index($referencia)
    {
        $client = new Client([ 'base_uri' => get_billy_url() ]);

        try {
            $response = $client->request('get', "/pagos/referencia/{$referencia}");
            $body     = $response->getBody();
            $data     = json_decode($body->getContents());

            return ok(compact('data'));
        } catch (GuzzleException $e) {
            if ($e->getCode() == 404) {
                return not_found([], $e->getMessage());
            }

            return unprocessable_entity([], $e->getMessage());
        }
    }
}
