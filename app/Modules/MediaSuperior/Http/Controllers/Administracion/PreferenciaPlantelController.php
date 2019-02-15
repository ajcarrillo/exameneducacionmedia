<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 15/02/2019
 * Time: 11:20 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use DB;

class PreferenciaPlantelController
{
    public function index()
    {
        $datos = DB::table('seleccion_ofertas_educativas')
                    ->select('aspirantes.folio', DB::raw("concat(users.nombre,' ',users.primer_apellido,' ',segundo_apellido) as nombre_completo"), 'especialidades.referencia as primera_opcion', 'subsistemas.referencia as subsistema', 'geo.NOM_MUN as municipio', 'revision_registros.efectuado as pago', DB::raw('IF(pases_examen.id, 1, 0) as concluyo_registo'))
                    ->join('aspirantes','aspirantes.id','=','seleccion_ofertas_educativas.aspirante_id')
                    ->join('users','users.id','=','aspirantes.user_id')
                    ->join('ofertas_educativas','ofertas_educativas.id','=','seleccion_ofertas_educativas.oferta_educativa_id')
                    ->join('especialidades','especialidades.id','=', 'ofertas_educativas.especialidad_id')
                    ->join('planteles','planteles.id','=','ofertas_educativas.plantel_id')
                    ->join('subsistemas','subsistemas.id','=','planteles.subsistema_id')
                    ->join('geodatabase.mun_loc_qroo_camp as geo','geo.CVE_MUN','=','planteles.cve_mun')
                    ->join('revision_registros','revision_registros.aspirante_id','=','aspirantes.id')
                    ->leftjoin('pases_examen','pases_examen.aspirante_id','=','aspirantes.id')
                    ->where('seleccion_ofertas_educativas.preferencia',1)
                    ->groupBy('aspirantes.id')
                    ->get();
        //dd($datos);
        return view('media_superior.administracion.preferenciaPlantel.index', compact('datos'));
    }
}