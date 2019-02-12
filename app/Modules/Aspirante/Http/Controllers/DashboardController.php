<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:05
 */

namespace Aspirante\Http\Controllers;


use Aspirante\Models\Aspirante;
use Aspirante\Models\Seleccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use ExamenEducacionMedia\Exports\UsersExport;

class DashboardController
{
    public function index()
    {
        $aspirante = get_aspirante();

        $ofertas_gral = DB::table('seleccion_ofertas_educativas as sel_of')
            ->join('ofertas_educativas as oferta', 'sel_of.oferta_educativa_id', '=', 'oferta.id')
            ->join('especialidades as esp', 'oferta.especialidad_id', '=', 'esp.id')
            ->join('planteles as plantel', 'oferta.plantel_id', '=', 'plantel.id')
            ->join('aspirantes', 'sel_of.aspirante_id', '=', 'aspirantes.id')
            ->select('plantel.latitud', 'plantel.longitud', 'sel_of.preferencia', 'esp.referencia', 'plantel.descripcion as plantel_desc', 'esp.descripcion as esp_desc')
            ->where('aspirantes.id', $aspirante->id)
            ->groupBy('plantel.id')
            ->get();

        $ofertas = Seleccion::with([ 'ofertaEducativa', 'ofertaEducativa.plantel', 'ofertaEducativa.especialidad' ])
            ->where('aspirante_id', $aspirante->id)
            ->orderBy('preferencia', 'asc')
            ->get();

        $revision               = $this->getRevision($aspirante);
        $hasRevision            = $this->hasRevision($aspirante);
        $paseAlExamen           = $this->getPaseAlExamen($aspirante);
        $hasPaseAlExamen        = $this->hasPaseAlExamen($aspirante);
        $hasInformacionCompleta = $aspirante->hasInformacionCompleta();

        return view('aspirante.dashboard', compact(
            'ofertas', 'ofertas_gral', 'revision', 'hasRevision',
            'paseAlExamen', 'hasPaseAlExamen', 'hasInformacionCompleta'
        ));
    }

    protected function getRevision(Aspirante $aspirante)
    {
        return $aspirante->revisiones()->first();
    }

    protected function hasRevision(Aspirante $aspirante)
    {
        return $aspirante->revisiones()->exists();
    }

    protected function getPaseAlExamen(Aspirante $aspirante)
    {
        return $aspirante->paseExamen;
    }

    public function hasPaseAlExamen(Aspirante $aspirante)
    {
        return $aspirante->paseExamen()->exists();
    }
    public function historicoCurp(){
        $query = DB::table('aspirantes')
            ->select('users.id', 'users.nombre', 'users.primer_apellido', 'users.segundo_apellido', 'users.email', 'aspirantes.telefono',  'geo.NOM_MUN', 'geo.NOM_LOC', 'domicilios.calle', 'domicilios.numero', 'domicilios.colonia', 'subsistemas.descripcion as subsistema', 'planteles.descripcion as plantel')
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('domicilios', 'domicilios.id', '=', 'aspirantes.domicilio_id')
            ->join('geodatabase.estados_municipios_localidades as geo', function($join){
                $join->on('geo.CVE_ENT', '=', 'domicilios.cve_ent')
                    ->on('geo.CVE_MUN', '=', 'domicilios.cve_mun')
                    ->on('geo.CVE_LOC', '=', 'domicilios.cve_loc');
            })
            ->join('seleccion_ofertas_educativas', 'seleccion_ofertas_educativas.aspirante_id', '=', 'aspirantes.id')
            ->join('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->join('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->join('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('subsistemas', 'subsistemas.id', '=', 'especialidades.subsistema_id')
            ->where('seleccion_ofertas_educativas.preferencia', 1)
            ->where('aspirantes.curp_historica', 1)
            ->orWhere('aspirantes.curp_valida', 0)
            ->groupBy('aspirantes.id');

        switch (Auth::user()->roles[0]->name){
            case 'plantel' :
                $query = $query->where('planteles.id', Auth::user()->plantel->id)
                    ->get();
                break;
            case  'departamento':
                $query = $query->get();
                break;

        }
        //dd(Auth::user()->roles[0]->name);
        return view('aspirante.problema_curp_historico', compact('query'));
    }

    public function descargar(Request $request)
    {
        return \Excel::download(new UsersExport(0,3), 'alumnos_con_problemas_de_curp.csv');
    }
}
