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
use Subsistema\Models\Plantel;

class ReportesController extends Controller
{
    public function descargar(Request $request)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('portrait')
            //->setOption('disable-smart-shrinking', true)
            ->setOption('footer-font-size', 10)

            ->setOption('encoding', 'utf-8')
            ->setOption('zoom', '1');

        $aulas = DB::table('planteles')
            ->select(DB::raw('count(aspirantes.id) as lugares_ocupados, aulas.id, aulas.capacidad, planteles.descripcion'))
            ->join('aulas', 'planteles.id', '=', 'aulas.edificio_id')
            ->join('pases_examen', 'pases_examen.aula_id', '=', 'aulas.id')
            ->join('aspirantes', 'aspirantes.id', '=', 'pases_examen.aspirante_id')
            ->where('planteles.id', Auth::user()->plantel->id)
            ->groupBy('aulas.id')
            ->get();

          $query = DB::table('pases_examen')
            ->join('aspirantes', 'pases_examen.aspirante_id', '=', 'aspirantes.id')
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('seleccion_ofertas_educativas', function ($join) {
                  $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                      ->where('seleccion_ofertas_educativas.preferencia', '=', 1);
              })
            ->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
            ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id')
            ->join('especialidades', 'ofertas_educativas.especialidad_id', '=', 'especialidades.id')
            ->join('aulas', function ($join) {
                  $join->on('pases_examen.aula_id', '=', 'aulas.id')
                      ->where('aulas.edificio_type', 'plantel');
              })
            ->where('planteles.id', Auth::user()->plantel->id);


        $formato = $request->formato;
        switch ($formato) {

            case 1 :
                $nombre_file = 'Listado_Alumnos_por_Aula';
                $query       = $query->select('aspirantes.id as aspirante','pases_examen.numero_lista', DB::raw('concat(users.primer_apellido," ",users.segundo_apellido," ",users.nombre) as nombre_completo'), 'aspirantes.folio as folio_ceneval', 'aulas.id as no_aula', 'aulas.capacidad', 'especialidades.referencia as especialidad', 'aulas.id')
                    //->groupBy('aulas.id', 'users.id')
                    ->orderBy('pases_examen.numero_lista', 'asc')
                    ->get();
                
                $pdf->setOption('header-html', view('planteles.header'))
                    ->setOption('footer-html', view('planteles.footer'))
                    ->setOption('margin-bottom', '20mm')
                    ->setOption('margin-top', '30mm')
                    ->setOption('margin-right', '0mm')
                    ->setOption('margin-left', '0mm');
                $pdf->loadView('planteles.reportes1', compact('query', 'aulas'));
                break;
            case 2:
                $nombre_file = 'reporte_de_acuse';
                $query       = $query->select('aulas.id', 'aulas.referencia', 'pases_examen.numero_lista', 'aulas.capacidad', DB::raw('concat(users.primer_apellido," ",users.segundo_apellido," ",users.nombre) as nombre_completo'), 'aulas.id as no_aula', 'aspirantes.folio', 'planteles.descripcion')->groupBy('aulas.id', 'users.id')->get();
                $pdf->setOrientation('landscape');
                $pdf->loadView('planteles.reportes2', compact('query', 'aulas'));
                break;
            case 3:
                $nombre_file = 'Listado_General_de_Alumnos';
                $plantel     = Plantel::find(Auth::user()->plantel->id);
                $query       = $query->select(DB::raw('concat(users.primer_apellido," ",users.segundo_apellido," ",users.nombre) as nombre_completo'),
                    'users.primer_apellido', 'users.segundo_apellido',
                    'users.nombre', 'aspirantes.folio as folio_ceneval', 'especialidades.referencia as especialidad',
                    'aulas.id as no_aula', 'aulas.id', 'aulas.referencia as aula_descripcion')
                    ->orderBy('users.primer_apellido', 'asc')
                    ->groupBy('aulas.id', 'users.id')
                    ->get();
                $pdf->loadView('planteles.reportes3', compact('query', 'plantel'));
                break;
        }

        return $pdf->inline($nombre_file . '.pdf');
    }

}