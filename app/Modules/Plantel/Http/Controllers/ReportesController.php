<?php
/**
 * Created by PhpStorm.
 * User: marlo
 * Date: 06/02/2019
 * Time: 10:35 AM
 */

namespace Plantel\Http\Controllers;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ReportesController extends Controller
{
    public function descargar(Request $request)
    {
         Auth::user()->plantel();

        $nombre_a_descargar = "nombre del archivo";
        $pdf                = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');
        $pdf->loadView('media_superior.administracion.carga_documentos.snappy');

         /* $pdf->loadView('ruta de la vista',
            [ 'Variables compact a la vista' ]
        ); */

       return $pdf->download('hola.pdf');

    }
}