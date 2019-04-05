<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-22
 * Time: 17:43
 */

namespace MediaSuperior\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class SubirArchivoPagosController extends Controller
{
    public function index()
    {
        $reportes = [];

        try {
            $client   = new Client([ 'base_uri' => get_billy_url() ]);
            $response = $client->request('get', '/pagos/reporte-pagos/');
            $reportes = json_decode((string)$response->getBody(), true);
            $reportes = $reportes['reportes'];
        } catch (GuzzleException $e) {

        }

        return view('administracion.pagos.index', compact('reportes'));
    }

    public function store(Request $request)
    {
        $archivo = $request->file('archivo');
        $banco   = $request->input('banco');

        $client = new Client([ 'base_uri' => env('BILLY_SERVICE_URL') ]);

        try {
            $response = $client->request('POST', '/pagos/deposito/reporte/', [
                'multipart' => [
                    [
                        'name'     => 'banco',
                        'contents' => $banco,
                    ],
                    [
                        'name'     => 'archivo',
                        'filename' => $archivo->getClientOriginalName(),
                        'contents' => fopen($archivo, 'r'),
                    ],
                ],
            ]);
            flash($response->getBody()->getContents())->success();
        } catch (GuzzleException $e) {
            flash($e->getMessage())->error();
        }

        return back();
    }
}
