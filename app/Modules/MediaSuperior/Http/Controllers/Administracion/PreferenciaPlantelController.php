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
        $t_filtro = "";
        $filtro = "";

        $datos = DB::table('aspirantes')
            ->select('aspirantes.id', 'aspirantes.folio', DB::raw("concat(users.nombre,' ',users.primer_apellido,' ',segundo_apellido) as nombre_completo"), 'especialidades.referencia as primera_opcion', 'subsistemas.referencia as subsistema', 'geo.NOM_MUN as municipio', DB::raw('IF(revision_registros.efectuado = null, "Pagado", "Pendiente") as pago'), DB::raw('IF(pases_examen.id = null, "Concluido", "Concluso") as concluyo_registo'))
            ->leftjoin('seleccion_ofertas_educativas', function ($join) {
                $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            })
            ->leftjoin('users', 'users.id', '=', 'aspirantes.user_id')
            ->leftjoin('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->leftjoin('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->leftjoin('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->leftjoin('subsistemas', 'subsistemas.id', '=', 'planteles.subsistema_id')
            ->leftjoin('geodatabase.municipios_view as geo', function ($join) {
                $join->on('geo.CVE_MUN', '=', 'planteles.cve_mun')
                    ->where('geo.CVE_ENT','=', 23);
            })
            ->leftjoin('revision_registros', 'revision_registros.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('pases_examen', 'pases_examen.aspirante_id', '=', 'aspirantes.id');
        //->paginate(10);

            switch (Auth::user()->roles[0]->name) {
                case 'plantel' :
                    $datos = $datos->where('planteles.id', Auth::user()->plantel->id);
                    break;
                case  'subsistema':
                    $datos = $datos->where('subsistemas.id', Auth::user()->plantel->subsistema_id);
                    break;
                case  'departamento':
                    switch ($request->get('t_filtro')) {
                        case '':
                            $datos = $datos;
                            break;
                        case 'subsistema':
                            $t_filtro = $request->t_filtro;
                            $filtro = $request->filtro;
                            $datos = $datos->where('subsistemas.referencia', 'LIKE', '%' . $request->get('filtro') . '%');
                            break;
                        case 'plantel':
                            $t_filtro = $request->t_filtro;
                            $filtro = $request->filtro;
                            $datos = $datos->where('planteles.descripcion', 'LIKE', '%' . $request->get('filtro') . '%');
                            break;
                    }
                    break;
            }
            $datos = $datos->paginate(10);

        return view('media_superior.administracion.preferencia_plantel.index', compact('datos', 't_filtro', 'filtro'));
    }

    public function descargarCsv(Request $request)
    {
        return \Excel::download(new UsersExport(0, 4, $request->get('t_filtro'), $request->get('filtro')), 'reporte_Preferencia_de_plantel.csv');
    }

    public function descargarPdf(Request $request)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');

        $datos = DB::table('aspirantes')
            ->select('aspirantes.id', 'aspirantes.folio', DB::raw("concat(users.nombre,' ',users.primer_apellido,' ',segundo_apellido) as nombre_completo"), 'especialidades.referencia as primera_opcion', 'subsistemas.referencia as subsistema', 'geo.NOM_MUN as municipio', DB::raw('IF(revision_registros.efectuado = null, "Pagado", "Pendiente") as pago'), DB::raw('IF(pases_examen.id = null, "Concluido", "Concluso") as concluyo_registo'))
            ->leftjoin('seleccion_ofertas_educativas', function ($join) {
                $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            })
            ->leftjoin('users', 'users.id', '=', 'aspirantes.user_id')
            ->leftjoin('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->leftjoin('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->leftjoin('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->leftjoin('subsistemas', 'subsistemas.id', '=', 'planteles.subsistema_id')
            ->leftjoin('geodatabase.municipios_view as geo', function ($join) {
                $join->on('geo.CVE_MUN', '=', 'planteles.cve_mun')
                    ->where('geo.CVE_ENT','=', 23);
            })
            ->leftjoin('revision_registros', 'revision_registros.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('pases_examen', 'pases_examen.aspirante_id', '=', 'aspirantes.id');


        switch (Auth::user()->roles[0]->name) {
            case 'plantel' :
                $datos = $datos->where('planteles.id', Auth::user()->plantel->id)->get();
                break;
            case  'subsistema':
                $datos = $datos->where('subsistemas.id', Auth::user()->plantel->subsistema_id)->get();
                break;
            case  'departamento':

                switch ($request->get('t_filtro')) {
                    case '':
                        $datos = $datos->get();
                        break;
                    case 'subsistema':
                        $t_filtro = $request->t_filtro;
                        $filtro = $request->filtro;
                        $datos = $datos->where('subsistemas.referencia', 'LIKE', '%' . $request->get('filtro') . '%')
                            ->get();
                        break;
                    case 'plantel':
                        $t_filtro = $request->t_filtro;
                        $filtro = $request->filtro;
                        $datos = $datos->where('planteles.descripcion', 'LIKE', '%' . $request->get('filtro') . '%')
                            ->get();
                        break;
                }
                break;
        }
        $pdf->loadView('media_superior.administracion.preferencia_plantel.reporte', compact('datos'));
        return $pdf->download('reporte_preferencia_de_plantel.pdf');
    }
}