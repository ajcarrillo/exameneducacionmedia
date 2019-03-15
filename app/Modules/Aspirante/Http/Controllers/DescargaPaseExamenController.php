<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 13/03/2019
 * Time: 11:09 AM
 */

namespace Aspirante\Http\Controllers;
use Aspirante\Models\Aspirante;
use DB;

class DescargaPaseExamenController
{
    public function reportePaseExamen($id)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');


        $configuracion = $query = DB::table('configuracion')
                        ->where('id', '=', 8)
                        ->orWhere('id', '=', 9)
                        ->get();
        $aspirante     = Aspirante::with('user', 'entidadNacimiento', 'informacionProcedencia', 'paseExamen.aula.edificio', 'domicilio.localidad')
            ->with([ 'opcionesEducativas' => function ($query) {
                $query->orderBy('preferencia');
            } ])
            ->with('opcionesEducativas.ofertaEducativa.plantel', 'opcionesEducativas.ofertaEducativa.especialidad')
            ->where('id', $id)->get();

        $pdf->loadView('aspirante.reportes.pase_examen', compact('aspirante','configuracion'));
        return $pdf->inline('pase_examen.pdf');
    }

    public function fichaPago($id)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');
        $ficha = Aspirante::with('revision')
                ->where('id',$id)
                ->get();
        $datos =  json_encode($ficha[0]->revision->ficha_json);
        $datos = json_decode($datos);
        //$datos = json_decode($ficha[0]->revision->ficha_json,false,512,0);

        //return $datos;
        $pdf->loadView('aspirante.reportes.ficha_pago', compact('datos'));
        return $pdf->inline('ficha_pago.pdf');
    }

}
