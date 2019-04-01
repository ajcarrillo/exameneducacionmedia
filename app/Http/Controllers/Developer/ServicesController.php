<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-31
 * Time: 22:04
 */

namespace ExamenEducacionMedia\Http\Controllers\Developer;


use ExamenEducacionMedia\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ServicesController extends Controller
{

    public function index()
    {
        $billyStatus = $this->checkBillyStatus();

        return view('developer_zone.services', compact('billyStatus'));
    }

    protected function checkBillyStatus()
    {
        $client = new Client([ 'base_uri' => env('BILLY_SERVICE_URL') ]);

        $response = $client->get('/check-service-on-line');

        return $response->getStatusCode() == 200 ? true : false;
    }

}
