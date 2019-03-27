<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 25/03/2019
 * Time: 02:51 PM
 */

namespace MediaSuperior\Http\Controllers;

use Subsistema\Repositories\OfertaEducativaRepository;
use Illuminate\Support\Facades\DB;

class ReporteOpcionesEducativasController
{
    public function index(OfertaEducativaRepository $repository)
    {

        $datos = $repository->catalogoOpcionesEducativas()->get();
        $mpios = $aulas = DB::table('geodatabase.municipios_view')->where('CVE_ENT', '23')->get();
        //dd($datos[0]);

        /*$filter=[];
        foreach($datos as $filter_result) {
            $filter[] = $filter_result['cve_mun'];
        }
        return count($filter);
        $filter=array_unique($filter);
        return $filter[0];
        */
        //return json_encode($datos);
        $pdf = app('snappy.pdf.wrapper');
        header('Content-Type: application/pdf');
        $pdf->setPaper('letter')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', '10mm')
            ->setOption('margin-top', '30mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('footer-font-size', 10)
            ->setOption('header-html', view('media_superior.administracion.opciones_educativas.header'))
            ->setOption('footer-center',utf8_decode('Página [page] de [topage]'))
            ->setOption('encoding', 'utf-8')
            //->setOption('footer-html','<p>hello</p>')
            ->setOption('zoom', '1');
        //$content = $pdf->getOutputFromHtml($html);


        //dd($mpios);

        //$aspirantes = Aspirante::dataForAspirantes1erOp();

        $pdf->loadView('media_superior.administracion.opciones_educativas.reporte', compact('datos','mpios'));

        return $pdf->inline('opciones_educativas.pdf');
    }

}