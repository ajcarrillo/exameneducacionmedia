<?php
/**
 * Created by PhpStorm.
 * User: MPROTO
 * Date: 15/02/2019
 * Time: 11:20 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use Auth;
use DB;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Exports\UsersExport;

class PreferenciaPlantelController
{
    public function index(Request $request)
    {
        $t_filtro = $request->t_filtro;
        $filtro = $request->filtro;

        $datos = DB::table('seleccion_ofertas_educativas')
                    ->select('aspirantes.id','aspirantes.folio', DB::raw("concat(users.nombre,' ',users.primer_apellido,' ',segundo_apellido) as nombre_completo"), 'especialidades.referencia as primera_opcion', 'subsistemas.referencia as subsistema', 'geo.NOM_MUN as municipio', DB::raw('IF(revision_registros.efectuado > 0, "Pagado", "Pendiente") as pago'), DB::raw('IF(pases_examen.id > 0, "Concluido", "Concluso") as concluyo_registo'))
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

                    ->groupBy('aspirantes.id');
                    //->paginate(10);

            switch (Auth::user()->roles[0]->name){
                case 'plantel' :
                    $datos = $datos->where('planteles.id', Auth::user()->plantel->id)
                        ->paginate(10);
                    break;
                case  'subsistema':
                    $datos = $datos->where('subsistemas.id', Auth::user()->plantel->subsistema_id)
                        ->paginate(10);
                    break;
                case  'departamento':
                    //$datos = $datos->paginate(10);
                    switch ($request->get('t_filtro')){
                        case '':
                            $datos = $datos->paginate(10);
                            break;
                        case 'subsistema':
                            $datos = $datos->where('subsistemas.referencia','LIKE', '%'.$request->get('filtro').'%')
                                ->paginate(10);
                            break;
                        case 'plantel':
                            $datos = $datos->where('planteles.descripcion','LIKE', '%'.$request->get('filtro').'%')
                                ->paginate(10);
                            break;
                    }
                    break;
            }

        return view('media_superior.administracion.preferencia_plantel.index', compact('datos','t_filtro','filtro'));
    }

    public function descargar(Request $request)
    {
        return \Excel::download(new UsersExport(0,4,$request->get('t_filtro'),$request->get('filtro')), 'reporte_Preferencia_de_plantel.csv');

    }
}