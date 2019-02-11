<?php
/**
 * Created by PhpStorm.
 * User: marlo
 * Date: 10/02/2019
 * Time: 09:22 PM
 */

namespace Plantel\Http\Controllers;

use Illuminate\Http\Request;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function descargar(Request $request)
    {

        $pdf                = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');

        $aulas = DB::table('planteles')
            ->select(DB::raw('count(aspirantes.id) as lugares_ocupados, aulas.id, aulas.capacidad, planteles.descripcion'))
            ->join('aulas', 'planteles.id', '=', 'aulas.edificio_id')
            ->join('pases_examen', 'pases_examen.aula_id', '=', 'aulas.id')
            ->join('aspirantes', 'aspirantes.id', '=', 'pases_examen.aspirante_id')
            ->where('planteles.id', Auth::user()->plantel->id)
            ->groupBy('aulas.id')
            ->get();

        $query = DB::table('ofertas_educativas')
            ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id')
            ->join('especialidades', 'ofertas_educativas.especialidad_id', '=', 'especialidades.id')
            ->join('aulas', 'planteles.id', '=', 'aulas.edificio_id')
            ->join('pases_examen', 'pases_examen.aula_id', '=', 'aulas.id')
            ->join('aspirantes', 'aspirantes.id', '=', 'pases_examen.aspirante_id')
            ->join('alumnos.alumnos as alumn', 'alumn.id', '=', 'aspirantes.alumno_id')
            ->where('planteles.id', Auth::user()->plantel->id);

        $formato = $request->formato;
        if ($formato == "1") {
            $nombre_file = 'reporte_1';
            $query = $query->select('pases_examen.numero_lista', 'nombre_completo', 'aspirantes.folio as folio_ceneval', 'aulas.id as no_aula', 'aulas.capacidad', 'especialidades.referencia as especialidad', 'aulas.id')
                ->get();
            $pdf->loadView('planteles.reportes1', compact('query', 'aulas'));
        } else if ($formato == "2") {
            $nombre_file = 'reporte_de_acuse';
            $query   = $query->select('aulas.id', 'aulas.referencia', 'pases_examen.numero_lista', 'aulas.capacidad', 'alumn.nombre_completo', 'aulas.id as no_aula', 'aspirantes.folio', 'planteles.descripcion')->groupBy('aulas.id', 'alumn.id')->get();
            $pdf->setOrientation('landscape');
            $pdf->loadView('planteles.reportes2', compact('query', 'aulas'));
        } else {
            $pdf->loadView('planteles.reportes1', [ 'query' => $query ]);
        }

        return $pdf->download($nombre_file . '.pdf');
    }
}