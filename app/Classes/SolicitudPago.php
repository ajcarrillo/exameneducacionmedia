<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-09
 * Time: 01:53
 */

namespace ExamenEducacionMedia\Classes;


use ExamenEducacionMedia\Contracts\ProviderInterface;
use GuzzleHttp\Client;

class SolicitudPago implements ProviderInterface
{
    const CONCEPTO = '026';
    const CANTIDAD = 1;

    protected $billyURL;
    private   $vigencia, $nombre_completo, $curp, $municipio, $localidad, $colonia, $calle, $numero;


    public function __construct($vigencia, $nombre_completo, $curp, $municipio, $localidad, $colonia, $calle, $numero)
    {
        $this->billyURL        = env('BILLY_SERVICE_URL');
        $this->vigencia        = $vigencia;
        $this->nombre_completo = $nombre_completo;
        $this->curp            = $curp;
        $this->municipio       = $municipio;
        $this->localidad       = $localidad;
        $this->colonia         = $colonia;
        $this->calle           = $calle;
        $this->numero          = $numero;
    }

    public function enviar()
    {
        $json = $this->serializeToJson();

        $guzzle = new Client;

        $response = $guzzle->request('POST', "{$this->billyURL}/solicitud-pago/", [
            'json' => $json,
        ]);

        $location = $response->getHeader('Location')[0];

        $split = explode("/", $location);

        return $split[2];
    }

    public static function verificarPago($solicitudId)
    {
        // TODO: Implement verificarPago() method.
    }

    /**
     * @return mixed
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * @return mixed
     */
    public function getNombreCompleto()
    {
        return $this->nombre_completo;
    }

    /**
     * @return mixed
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @return mixed
     */
    public function getColonia()
    {
        return $this->colonia;
    }

    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return array
     */
    protected function serializeToJson(): array
    {
        return [
            'concepto'      => self::CONCEPTO,
            'cantidad'      => self::CANTIDAD,
            'vigencia'      => $this->vigencia,
            'descuento'     => 0,
            'contribuyente' => [
                'nombre_completo' => $this->nombre_completo,
                'curp'            => $this->curp,
                'municipio'       => $this->municipio,
                'localidad'       => $this->localidad,
                'colonia'         => $this->colonia,
                'calle'           => $this->calle,
                'numero'          => $this->numero,
            ],
        ];
    }
}
