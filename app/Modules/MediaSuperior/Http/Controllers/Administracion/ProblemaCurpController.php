<?php

namespace MediaSuperior\Http\Controllers\Administracion;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Exports\UsersExport;


class ProblemaCurpController
{
    public function index()
    {
        $query = DB::table('aspirantes')
            ->select('users.id', 'users.nombre', 'users.primer_apellido', 'users.segundo_apellido', 'users.email', 'aspirantes.telefono', 'geo.NOM_MUN', 'geo.NOM_LOC', 'domicilios.calle', 'domicilios.numero', 'domicilios.colonia', 'subsistemas.descripcion as subsistema', 'planteles.descripcion as plantel')
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('domicilios', 'domicilios.id', '=', 'aspirantes.domicilio_id')
            ->join('geodatabase.estados_municipios_localidades as geo', function ($join) {
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
            ->where('aspirantes.pais_nacimiento_id', '=', 'MX')
            ->where(function ($query) {
                $query->where('aspirantes.curp_historica', 1)
                    ->orWhere('aspirantes.curp_valida', 0);
            });


        switch (Auth::user()->roles[0]->name) {
            case 'plantel' :
                //$query = $query->get();
                $query = $query->where('aspirantes.user_id', Auth::user()->id)
                    ->get();
                break;
            case  'departamento':
                $query = $query->get();
                break;
        }

        return view('media_superior.administracion.problemaCurp.problema_curp_historico', compact('query'));
    }

    public function descargar(Request $request)
    {
        return \Excel::download(new UsersExport(0, 3), 'alumnos_con_problemas_de_curp.csv');
    }
}
