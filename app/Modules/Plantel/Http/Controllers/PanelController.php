<?php

namespace Plantel\Http\Controllers;

use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;

class PanelController extends Controller
{
    public function index()
    {

        $usuario_id = Auth::user()->id;

        $var = Plantel::with("responsable")->where("responsable_id", $usuario_id)->get();
        foreach ($var as $r) {
            $id_plantel = $r->id;
            $nombre_plantel= $r->descripcion;
        }
        $total_oferta = OfertaEducativa::where('plantel_id', $id_plantel)->count();
        $sqlof        = 'SELECT COUNT( DISTINCT t.aspirante_id) as aspirante_id
                FROM seleccion_ofertas_educativas as t
                LEFT JOIN ofertas_educativas as oe on t.oferta_educativa_id = oe.id
                WHERE oe.plantel_id =' . $id_plantel;
        $respuestaof  = DB::select($sqlof);
        foreach ($respuestaof as $r) {
            $total_demanda = $r->aspirante_id;
        }

        $sqlpass      = 'SELECT COUNT(DISTINCT(t.aspirante_id)) as aspirante_id
                FROM pases_examen as t
                LEFT JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = t.aspirante_id
                LEFT JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
                WHERE oe.plantel_id =' . $id_plantel;
        $respuestapas = DB::select($sqlpass);
        foreach ($respuestapas as $rp) {
            $aspirantes_proceso_completo = $rp->aspirante_id;
        }

        $sqlp       = 'SELECT COUNT(DISTINCT(t.aspirante_id)) as aspirante_id
            FROM revision_registros as t
            LEFT JOIN seleccion_ofertas_educativas as sof on sof.aspirante_id = t.aspirante_id
            LEFT JOIN ofertas_educativas as oe on oe.id = sof.oferta_educativa_id
            WHERE oe.plantel_id =' . $id_plantel . ' and t.efectuado = 0';
        $respuestap = DB::select($sqlp);
        foreach ($respuestap as $rpp) {
            $aspirantes_sin_pago = $rpp->aspirante_id;
        }

        $Aula       = DB::table('aulas');
        $aforo_suma = $Aula->where('edificio_id', $id_plantel)->sum('capacidad');
        $aulas      = $Aula->where('edificio_id', $id_plantel)->count('id');
        if($aforo_suma == 0){
            $porcentaje= 0;
        }else{
            $division=($aspirantes_proceso_completo / $aforo_suma) * 100;
            $porcentaje = round($division);
        }
        $sede  = 'SELECT DISTINCT (t.id) as id_sede ,t.descripcion as sede 
            , SUM(au.capacidad) as capacidad_aula
            , COUNT(DISTINCT au.id) as aulas,
            (SELECT COUNT(edificio_id) 
            FROM pases_examen
            INNER JOIN aulas ON aulas.id = pases_examen.aula_id AND aulas.edificio_type = "sede_alterna"
            WHERE aulas.edificio_id = t.id GROUP BY edificio_id
            ) as capacidad_ocupada
            FROM sedes_alternas as t
            INNER JOIN aulas as au on au.edificio_id = t.id
            WHERE t.plantel_id = ' . $id_plantel . ' AND au.edificio_type = "sede_alterna"
            GROUP BY (t.id)';
        $sedes = DB::select($sede);

        return view('planteles.home', compact('total_oferta','nombre_plantel', 'total_demanda', 'aspirantes_proceso_completo', 'aspirantes_sin_pago', 'aforo_suma', 'aulas', 'porcentaje', 'sedes'));
    }
}
