<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-25
 * Time: 01:21
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ReporteDepositosController extends Controller
{
    public function index()
    {

        $client = new Client([ 'base_uri' => get_billy_url() ]);

        $response = $client->request('get', '/pagos/reporte-pagos/');

        $reportes = json_decode((string)$response->getBody(), true);

        return view('administracion.pagos.reportes', [ 'reportes' => $reportes['reportes'] ]);
    }
}
