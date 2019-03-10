<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-09
 * Time: 01:53
 */

namespace ExamenEducacionMedia\Classes;


use Aspirante\Models\Aspirante;
use ExamenEducacionMedia\Contracts\ProviderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

class SolicitudPago implements ProviderInterface
{
    const CONCEPTO = '026';
    const CANTIDAD = 1;
    const MESSAGE  = 'Por el momento no se puede genear tu ficha de deposito';

    protected $billyURL;
    protected $vigencia;
    protected $nombre_completo;
    protected $curp;
    protected $municipio;
    protected $localidad;
    protected $colonia;
    protected $calle;
    protected $numero;
    protected $aspirante;

    public $solicitudPagoId;

    public function __construct(Aspirante $aspirante)
    {
        $this->billyURL  = env('BILLY_SERVICE_URL');
        $this->aspirante = $aspirante;
    }

    public function enviar()
    {
        $json = $this->getSolicituPago();

        try {
            $response = $this->generaSolicitudPago($json);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

        $location = $response->getHeader('Location')[0];

        $split = explode("/", $location);

        $this->solicitudPagoId = $split[2];

        return $this;
    }

    public static function getFichaPago($solicitudId)
    {
        $guzzle = new Client;

        $url = env('BILLY_SERVICE_URL');

        try {
            $response = $guzzle->get("{$url}/solicitud-pago/{$solicitudId}/");
        } catch (\Exception $e) {
            \Log::info('*****obtiendo-json-ficha******');
            \Log::error($e->getMessage());
            \Log::info('*****obtiendo-json-ficha******');
            throw new \Exception("Error al conectar con billy", 422);
        }

        $status = $response->getStatusCode();

        if ($status != 200) {
            throw new \Exception('Por el momento no se puede obtener la información de la ficha de pago');
        }

        return $response->getBody();
    }

    public static function verificarPago($solicitudId)
    {
        // TODO: Implement verificarPago() method.
    }

    /**
     * @return array
     */
    protected function getSolicituPago(): array
    {
        $this->mapSolicituPago();

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

    protected function mapSolicituPago()
    {
        $registro              = get_etapa('REGISTRO');
        $aspirante             = $this->aspirante;
        $this->vigencia        = (string)$registro->cierre;
        $this->nombre_completo = "{$aspirante->user->nombre} {$aspirante->user->primer_apellido} {$aspirante->user->segundo_apellido}";
        $this->curp            = $aspirante->curp;
        $this->municipio       = Str::substr($aspirante->domicilio->municipio->CVE_MUN, 1, 2);
        $this->localidad       = $aspirante->domicilio->localidad->NOM_LOC;
        $this->colonia         = $aspirante->domicilio->colonia;
        $this->calle           = $aspirante->domicilio->calle;
        $this->numero          = $aspirante->domicilio->numero;
    }

    /**
     * @param array $json
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    protected function generaSolicitudPago(array $json)
    {
        $guzzle = new Client;

        try {
            $response = $guzzle->request('POST', "{$this->billyURL}/solicitud-pago/", [
                'json' => $json,
            ]);
        } catch (GuzzleException $e) {
            \Log::info('*******************');
            \Log::error($e->getMessage());
            \Log::info('*******************');
            throw new \Exception(self::MESSAGE, 422);
        }

        $status = $response->getStatusCode();

        if ($status != 201) {
            if ($status == 400) {
                throw new \Exception((string)$response->getBody(), 400);
            } else {
                throw new \Exception(self::MESSAGE, 422);
            }
        }

        return $response;
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
}
