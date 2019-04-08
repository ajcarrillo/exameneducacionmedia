<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 25/03/2019
 * Time: 02:51 PM
 */

namespace MediaSuperior\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Subsistema\Repositories\OfertaEducativaRepository;
use Subsistema\Repositories\PlantelRepository;


class ReporteOpcionesEducativasController
{
    public function index(OfertaEducativaRepository $repository)
    {

        $datos = $repository->catalogoOpcionesEducativas()->get();
        $mpios = $aulas = DB::table('municipios_view')->where('CVE_ENT', '23')->get();

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
            ->setOption('zoom', '1');

        $pdf->loadView('media_superior.administracion.opciones_educativas.reporte', compact('datos','mpios'));
        return $pdf->inline('opciones_educativas.pdf');
    }

    public function reporteOferta(Request $request, PlantelRepository $plantelRepository){
        $datos = $plantelRepository->ofertaEducativa(['subsitema'=>$request->subsistema_ofertas, 'plantel'=>$request->plantel_ofertas, 'municipio'=>$request->municipio])->get();
        //$datos = $plantelRepository->ofertaEducativa()->get();
        //dd($datos);
        $graf = [];
        //return $datos->groupBy('municipio');

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
            ->setOption('zoom', '1');

        $pdf->loadView('media_superior.administracion.ofertaEducativa.reporte', compact('datos','graf'));
        if($datos->count() > 0){
            return $pdf->download('ofertas_educativas.pdf');
        }

    }

}
