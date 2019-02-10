<?php

namespace ExamenEducacionMedia\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Subsistema\Models\Subsistema;
use Maatwebsite\Excel\Concerns\WithHeadings;


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
        $this->formato    = $formato;
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
            ->where('a.edificio_type','=','plantel')
            ->get();
    }

    public function collection()
    {

        if ($this->formato == 1) {
            $ofertaEducativa = $this->dataOferta();

            return $ofertaEducativa;
        }

        if ($this->formato == 2) {
            $aforo = $this->dataAforo();

            return $aforo;
        }
    }

    public function headings(): array
    {
        $columnas = array();
        if ($this->formato == 1) {
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
        } elseif ($this->formato == 2) {
            $columnas = [
                'descripcion',
                'aulas',
                'capacidad',
                'ocupados',
                'disponibles',
            ];
        }

        return $columnas;
    }
}
