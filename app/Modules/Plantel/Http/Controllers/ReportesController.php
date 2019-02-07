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
use Illuminate\Support\Facades\DB;

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

        $query = DB::table('aulas')
            //->select()
            //->from('aulas')
            ->join('planteles', 'aulas.edificio_id', '=', 'planteles.id')
            ->join('pases_examen', 'pases_examen.aula_id', '=', 'aulas.id')
            ->join('aspirantes', 'aspirantes.id', '=', 'pases_examen.aspirante_id')
            ->join('alumnos.alumnos as alumn','alumn.id','=','aspirantes.alumno_id')
            ->join('seleccion_ofertas_educativas as ofertas', 'ofertas.aspirante_id', '=', 'aspirantes.id')
            ->join('ofertas_educativas as ofertas_edu', 'ofertas_edu.id', '=', 'ofertas.oferta_educativa_id')
            ->join('especialidades', 'ofertas_edu.especialidad_id', '=', 'especialidades.id')
            ->where('planteles.id', Auth::user()->plantel->id)
            //->groupBy('plantel.id')
            ->get();
            //dd($query);
        $formato = $request->formato;

        if ($formato == "1") {
            $pdf ->setOrientation('landscape');
            $pdf->loadView('planteles.reportes1', ['query' => $query]);
        } else if ($formato == "2") {
            $pdf->loadView('planteles.reportes1', ['query' => $query]);
        } else {
            $pdf->loadView('planteles.reportes1', ['query' => $query]);
        }
         /* $pdf->loadView('ruta de la vista',
            [ 'Variables compact a la vista' ]
        ); */

       return $pdf->download('hola.pdf');

    }
}