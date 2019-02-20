<?php

namespace ExamenEducacionMedia\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Subsistema\Models\Subsistema;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;


class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $subsistema;
    protected $formato;

    public function __construct($subsistema, $formato)
    {
        $this->subsistema = $subsistema;
        $this->formato = $formato;
    }

    public function dataOferta()
    {
        //Consulta para obtener los datos de la oferta con las columnas de nombre del plantel, cct, localidad, domicilio,
        // especialidad, total de grupos, total de alumnos por grupo, total de alumnos
        return DB::table('educacionmedia.subsistemas as s')
            ->select('p.descripcion', 'p.clave', 'ml.NOM_LOC',
                DB::raw('concat_ws(" ",p.calle_principal,p.calle_izquierda,p.calle_derecha,p.colonia,p.codigo_postal) as domicilio'),
                'e.referencia', 'oeg.grupos', 'oeg.alumnos',
                DB::raw('(oeg.grupos * oeg.alumnos) as total'))
            ->join('educacionmedia.planteles as p', 's.id', '=', 'p.subsistema_id')
            ->join('educacionmedia.ofertas_educativas as oe', 'p.id', '=', 'oe.plantel_id')
            ->join('educacionmedia.oferta_educativa_grupos as oeg', 'oe.id', '=', 'oeg.oferta_educativa_id')
            ->join('educacionmedia.especialidades as e', 'oe.especialidad_id', '=', 'e.id')
            ->join('geodatabase.mun_loc_qroo_camp  as ml', function ($join) {
                $join->on('ml.CVE_ENT', '=', 'p.cve_ent');
                $join->on('ml.CVE_MUN', '=', 'p.cve_mun');
                $join->on('ml.CVE_LOC', '=', 'p.cve_loc');
            })
            ->where('s.id', '=', $this->subsistema)
            ->get();
    }

    public function dataAforo()
    {
        //Consulta para obtener los datos del aforo con  las columnas de nombre del plantel, total de aulas registradas,
        // capacidad, lugares ocupados, lugares disponibles
        return DB::table('educacionmedia.subsistemas as s')
            ->select('p.descripcion',
                DB::raw('count(a.id) as aulas'),
                DB::raw('sum(a.capacidad) as capacidad, 
                (SELECT count(p2.id)
                FROM pases_examen
                INNER JOIN aulas a2 ON pases_examen.aula_id = a2.id
                INNER JOIN planteles p2 ON p2.id = a2.edificio_id AND a2.edificio_type = "plantel"
                where p2.id=p.id
                GROUP BY p2.id) as ocupados'),
                DB::raw('(sum(a.capacidad)-(SELECT count(p2.id)
                FROM pases_examen
                INNER JOIN aulas a2 ON pases_examen.aula_id = a2.id
                INNER JOIN planteles p2 ON p2.id = a2.edificio_id AND a2.edificio_type = "plantel"
                where p2.id=p.id
                GROUP BY p2.id)) as disponible'))
            ->join('educacionmedia.planteles as p', 's.id', '=', 'p.subsistema_id')
            ->join('educacionmedia.aulas as a', function ($join) {
                $join->on('a.edificio_id', '=', 'p.id');
            })
            ->where('s.id', '=', $this->subsistema)
            ->where('a.edificio_type', '=', 'plantel')
            ->get();
    }

    public function dataAlumnos()
    {
        $query = DB::table('aspirantes')
            ->select(DB::raw('concat(users.nombre," ",users.primer_apellido," ", users.segundo_apellido) as nombre_full'), 'users.email', 'aspirantes.telefono', 'geo.NOM_MUN as municipio', 'geo.NOM_LOC as localidad', 'domicilios.calle', 'domicilios.numero', 'domicilios.colonia', 'subsistemas.descripcion as subsistema', 'planteles.descripcion as plantel', DB::raw('if(aspirantes.curp_historica > 0, "Si","No") as curp_historica'), DB::raw('if(aspirantes.curp_valida > 0, "Si","No") as curp_valida'))
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
                $query = $query->where('planteles.id', Auth::user()->plantel->id)
                    ->get();
                break;
            case  'departamento':
                $query = $query->get();
                break;

        }
        return $query;
    }

    public function dataPreferencias(){
        $datos = DB::table('seleccion_ofertas_educativas')
            ->select('aspirantes.folio', DB::raw("concat(users.nombre,' ',users.primer_apellido,' ',segundo_apellido) as nombre_completo"), 'especialidades.referencia as primera_opcion_especialidad', 'subsistemas.referencia as subsistema', 'geo.NOM_MUN as municipio', DB::raw('IF(revision_registros.efectuado = null, "Pagado", "Pendiente") as pago'), DB::raw('IF(pases_examen.id = null, "Concluido", "Concluso") as concluyo_registo'))
            ->leftjoin('seleccion_ofertas_educativas', function ($join) {
                $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            })
            ->leftjoin('users', 'users.id', '=', 'aspirantes.user_id')
            ->leftjoin('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->leftjoin('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->leftjoin('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->leftjoin('subsistemas', 'subsistemas.id', '=', 'planteles.subsistema_id')
            ->leftjoin('geodatabase.mun_loc_qroo_camp as geo', 'geo.CVE_MUN', '=', 'planteles.cve_mun')
            ->leftjoin('revision_registros', 'revision_registros.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('pases_examen', 'pases_examen.aspirante_id', '=', 'aspirantes.id')
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
                switch ($_GET['t_filtro']){
                    case '':
                        $datos = $datos->paginate(10);
                        break;
                    case 'subsistema':
                        $datos = $datos->where('subsistemas.referencia','LIKE', '%'.$_GET['filtro'].'%')
                            ->paginate(10);
                        break;
                    case 'plantel':
                        $datos = $datos->where('planteles.descripcion','LIKE', '%'.$_GET['filtro'].'%')
                            ->paginate(10);
                        break;
                }
                break;
        }
        return $datos;
    }

    public function collection()
    {
        switch ($this->formato) {
            case 1 :
                $ofertaEducativa = $this->dataOferta();
                return $ofertaEducativa;
                break;
            case 2 :
                $aforo = $this->dataAforo();
                return $aforo;
                break;
            case 3 :
                $alumnos = $this->dataAlumnos();
                return $alumnos;
                break;
            case 4 :
                $preferencias = $this->dataPreferencias();
                return $preferencias;
                break;
        }

    }

    public function headings(): array
    {
        $columnas = array();

        switch ($this->formato) {
            case 1 :
                $columnas = [
                    'descripcion',
                    'clave',
                    'nombre localidad',
                    'domicilio',
                    'especialidad',
                    'total grupos',
                    'alumnos por grupo',
                    'total alumnos',
                ];
                break;
            case 2 :
                $columnas = [
                    'descripcion',
                    'aulas',
                    'capacidad',
                    'ocupados',
                    'disponibles',
                ];
                break;
            case 3 :
                $columnas = [
                    'nombre_completo',
                    'email',
                    'telefono',
                    'municipio',
                    'localidad',
                    'calle',
                    'numero',
                    'colonia',
                    'subsistema',
                    'plantel',
                    'curp_historica',
                    'curp_valida'
                ];
                break;
            case 4 :
                $columnas = [
                    'folio',
                    'nombre_completo',
                    'primera_opcion_especialidad',
                    'subsistema',
                    'municipio',
                    'pago',
                    'concluyo_registo'
                ];
                break;
        }

        return $columnas;
    }
}
