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

    public function __construct($subsistema)
    {
        $this->subsistema = $subsistema;
    }

    public function collection()
    {
        $ofertaEducativa = DB::table('educacionmedia.subsistemas as s')
            ->select('p.descripcion','p.clave','ml.NOM_LOC',
                DB::raw('concat_ws(" ",p.calle_principal,p.calle_izquierda,p.calle_derecha,p.colonia,p.codigo_postal) as domicilio'),
                'e.referencia','oeg.grupos','oeg.alumnos',
                DB::raw('(oeg.grupos * oeg.alumnos) as total'))
            ->join('educacionmedia.planteles as p','s.id','=','p.subsistema_id')
            ->join('educacionmedia.ofertas_educativas as oe','p.id','=','oe.plantel_id')
            ->join('educacionmedia.oferta_educativa_grupos as oeg','oe.id','=','oeg.oferta_educativa_id')
            ->join('educacionmedia.especialidades as e','oe.especialidad_id','=','e.id')
            ->join('geodatabase.mun_loc_qroo_camp  as ml',function ($join){
                $join->on('ml.CVE_ENT','=','p.cve_ent');
                $join->on('ml.CVE_MUN','=','p.cve_mun');
                $join->on('ml.CVE_LOC','=','p.cve_loc');
            })
            ->where('s.id', '=', $this->subsistema)
            ->get();

        return $ofertaEducativa;
    }

    public function headings(): array
    {
        return [
            'descripcion',
            'clave',
            'nombre localidad',
            'domicilio',
            'especialidad',
            'total grupos',
            'alumnos por grupo',
            'total alumnos'
        ];
    }
}
