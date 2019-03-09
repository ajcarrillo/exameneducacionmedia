<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-09
 * Time: 02:33
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Classes\SolicitudPago;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Support\Str;

class SolicitudPagoController extends Controller
{
    public function send()
    {
        $aspirante       = get_aspirante();
        $vigencia        = '2019-12-30';
        $nombre_completo = "{$aspirante->user->nombre} {$aspirante->user->primer_apellido} {$aspirante->user->segundo_apellido}";
        $curp            = $aspirante->curp;
        $municipio       = Str::substr($aspirante->domicilio->municipio->CVE_MUN, 1, 2);
        $localidad       = $aspirante->domicilio->localidad->NOM_LOC;
        $colonia         = $aspirante->domicilio->colonia;
        $calle           = $aspirante->domicilio->calle;
        $numero          = $aspirante->domicilio->numero;

        $solicitud = new SolicitudPago($vigencia, $nombre_completo, $curp, $municipio, $localidad, $colonia, $calle, $numero);

        $response  = $solicitud->enviar();

        return ok(compact('response'));
    }
}
