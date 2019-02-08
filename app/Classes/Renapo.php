<?php
/**
 * Created by PhpStorm.
 * User: jsantos
 * Date: 19/03/18
 * Time: 21:30
 */

namespace ExamenEducacionMedia\Classes;


use ExamenEducacionMedia\Models\Entidad;
use ExamenEducacionMedia\Models\Pais;

class Renapo
{
    private static $url      = null;
    public         $_object  = null;
    private        $response = [ 'id'               => null,
                                 'curp'             => null,
                                 'curp_actual'      => null,
                                 'nombre'           => null,
                                 'primer_apellido'  => null,
                                 'segundo_apellido' => null,
                                 'sexo'             => null,
                                 'fecha_nacimiento' => null,
                                 'entidad_id'       => null,
                                 'pais_id'          => null,
                                 'es_historica'     => null,
                                 'alumno_id'        => null ];

    function __construct()
    {
        self::$url = env('RENAPO_URL');
    }

    /**
     * @return mixed|null
     */
    public function consultarCurp($curp = null)
    {
        return $this->setConnection($curp);
    }

    /**
     * @param $curp
     * @return array|null
     */
    public function setConnection($curp)
    {
        $datos      = null;
        $parametros = array( "txtCurp" => strip_tags($curp) );
        $par        = sprintf('%s', http_build_query($parametros));
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url . "ServiceAction");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $par);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        $remote_server_output = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
            $r_json = json_decode(mb_convert_encoding($remote_server_output, "UTF-8", "ISO-8859-1"));

            if (!empty($r_json->CURP)) {
                $this->response['curp']             = $curp;
                $this->response['curp_actual']      = $r_json->CURP;
                $this->response['nombre']           = !empty($r_json->nombres) ? $r_json->nombres : '';
                $this->response['primer_apellido']  = !empty($r_json->apellido1) ? $r_json->apellido1 : '';
                $this->response['segundo_apellido'] = !empty($r_json->apellido2) ? $r_json->apellido2 : '';
                $this->response['sexo']             = $r_json->sexo;
                $this->response['fecha_nacimiento'] = \DateTime::createFromFormat('d/m/Y', $r_json->fechNac)->format('Y-m-d');
                $this->response['es_historica']     = ($r_json->CURP != $curp) ? true : false;
            }
        }
        curl_close($ch);

        return $this->response;
    }

    /**
     * @param $letra_entidad
     * @return mixed|null
     */
    public function getPaisNacimiento($letra_entidad)
    {
        return ($letra_entidad == 'NE') ? null : Pais::where('codigo', '=', 'MX')->first()->id;
    }

    public function convertObjectToResult($curp)
    {
        $this->response['alumno_id']        = $this->_object->id;
        $this->response['curp']             = $curp;
        $this->response['curp_actual']      = $this->_object->curp;
        $this->response['nombre']           = !empty($this->_object->nombre) ? $this->_object->nombre : '';
        $this->response['primer_apellido']  = !empty($this->_object->primer_apellido) ? $this->_object->primer_apellido : '';
        $this->response['segundo_apellido'] = !empty($this->_object->segundo_apellido) ? $this->_object->segundo_apellido : '';
        $this->response['sexo']             = $this->_object->sexo;
        $this->response['fecha_nacimiento'] = $this->_object->fecha_nacimiento;
        $this->response['entidad_id']       = $this->_object->entidad_id;
        $this->response['pais_id']          = $this->_object->pais_id;
        $this->response['es_historica']     = ($this->_object->curp != $curp) ? true : false;

        return $this->response;
    }

    /**
     * @param $letra_entidad
     * @return mixed|null
     */
    private function getEntidad($letra_entidad)
    {
        $entidad = Entidad::where('clave', '=', $letra_entidad)->first();

        return (isset($entidad->id)) ? $entidad->id : null;
    }


}
