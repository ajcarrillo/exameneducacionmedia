<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function descargar(Request $request)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');

        //$aspirantes = Aspirante::with('informacionProcedencia', 'opcionesEducativas', 'user','paseExamen','revisiones')->get();

        $aspirantes = DB::table('aspirantes')
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('informacion_procedencias', 'informacion_procedencias.id', '=', 'aspirantes.informacion_procedencia_id')
            ->leftjoin('pases_examen', 'pases_examen.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('seleccion_ofertas_educativas', 'seleccion_ofertas_educativas.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->leftjoin('revision_registros', 'revision_registros.aspirante_id', '=', 'aspirantes.id')
            ->groupBy('aspirantes.id')
            ->orderBy('informacion_procedencias.clave_centro_trabajo')
            ->orderBy('users.nombre')
            ->select('aspirantes.folio',
                DB::raw('concat(users.primer_apellido," ",users.segundo_apellido," ",users.nombre) as nombre_completo'),
                'ofertas_educativas.clave as opcion_educativa_clave',
                DB::raw('concat(informacion_procedencias.clave_centro_trabajo," - ",informacion_procedencias.nombre_centro_trabajo) as nombre_centro_trabajo'),
                DB::raw('SUBSTRING(informacion_procedencias.clave_centro_trabajo,3,3) as modalidad'),
                'informacion_procedencias.clave_centro_trabajo',
                'revision_registros.efectuado as revision_efectuada',
                'pases_examen.id as pase_examen')
            ->get();

        $formato = $request->formato;
        switch ($formato) {
            case 'listado-primera-opcion-secundaria':
                $pdf->loadView('administracion.reportes.aspirantes-1opc-sec', compact('aspirantes'));
                break;
            default:
                abort(404, 'el reporte solicitado no existe');
        }

        return $pdf->download($formato . '.pdf');
    }
}