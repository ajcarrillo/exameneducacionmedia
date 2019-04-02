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

        try {
            $response = $client->get('/check-service-on-line');
            $status   = $response->getStatusCode();
        } catch (\Exception $e) {
            $status = NULL;
        }

        return $status == 200 ? true : false;
    }

}
