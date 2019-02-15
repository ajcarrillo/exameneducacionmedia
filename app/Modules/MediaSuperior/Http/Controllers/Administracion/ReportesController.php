<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 15/02/2019
 * Time: 11:20 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use DB;

class ReportesController
{
    public function index()
    {
        $query = DB::table('seleccion_ofertas_educativas')
                    ->join('aspirantes','aspirantes.id','=','seleccion_ofertas_educativas.aspirante_id')
                    ->join('users','users.id','=','aspirantes.user_id')
                    ->join('ofertas_educativas','ofertas_educativas.id','=','seleccion_ofertas_educativas.oferta_educativa_id')
                    ->join('especialidades','especialidades.id','=', 'ofertas_educativas.especialidad_id')
                    ->join('planteles','planteles.id','=','ofertas_educativas.plantel_id')
                    ->join('subsistemas','subsistemas.id','=','planteles.subsistema_id')
                    ->join('geodatabase.mun_loc_qroo_camp as geo','geo.CVE_MUN','=','planteles.cve_mun')
                    ->leftjoin('pases_examen','pases_examen.aspirante_id','=','aspirantes.id')
                    ->where('seleccion_ofertas_educativas.preferencia',1)
                    ->groupBy('aspirantes.id')
                    ->get();
        dd($query);

    }
}