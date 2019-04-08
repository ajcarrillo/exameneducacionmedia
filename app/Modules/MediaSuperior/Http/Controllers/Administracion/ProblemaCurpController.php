<?php

namespace MediaSuperior\Http\Controllers\Administracion;


use Aspirante\Models\Aspirante;
use Auth;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Exports\UsersExport;


class ProblemaCurpController extends Controller
{
    public function index()
    {
        $query = Aspirante::query()
            ->select('users.id', 'users.nombre', 'users.primer_apellido', 'users.segundo_apellido',
                'users.email', 'aspirantes.telefono', 'geo.NOM_MUN', 'geo.NOM_LOC', 'domicilios.calle',
                'domicilios.numero', 'domicilios.colonia', 'subsistemas.referencia as subsistema',
                'planteles.descripcion as plantel', DB::raw('if(aspirantes.curp_historica > 0, "Si","No") as historica'),
                DB::raw('if(aspirantes.curp_valida > 0, "Si","No") as valida'),
                'aspirantes.curp', 'aspirantes.folio', 'aspirantes.matricula'
            )
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('domicilios', 'domicilios.id', '=', 'aspirantes.domicilio_id')
            ->join('geodatabase.mun_loc_qroo_camp as geo', function ($join) {
                $join->on('geo.CVE_ENT', '=', 'domicilios.cve_ent')
                    ->on('geo.CVE_MUN', '=', 'domicilios.cve_mun')
                    ->on('geo.CVE_LOC', '=', 'domicilios.cve_loc');
            })
            ->join('seleccion_ofertas_educativas', function ($join) {
                $join->on('seleccion_ofertas_educativas.aspirante_id', '=', 'aspirantes.id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            })
            ->join('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->join('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->join('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('subsistemas', 'subsistemas.id', '=', 'especialidades.subsistema_id')
            ->whereNotNull('aspirantes.curp')
            ->where(function ($query) {
                $query->where('aspirantes.curp_historica', 1)
                    ->orWhere('aspirantes.curp_valida', 0);
            });

        if (Auth::user()->hasRole([ 'supermario', 'departamento' ])) {
            $query = $query->get();
        } elseif (Auth::user()->hasRole([ 'plantel' ])) {
            $query = $query->where('planteles.id', Auth::user()->plantel->id)->get();
        }

        return view('media_superior.administracion.problemaCurp.problema_curp_historico', compact('query'));
    }

    public function descargar(Request $request)
    {
        return \Excel::download(new UsersExport(0, 3), 'alumnos_con_problemas_de_curp.csv');
    }
}
