<?php

namespace ExamenEducacionMedia\Models\Geodatabase;

use Illuminate\Database\Eloquent\Model;

class Inegi extends Model
{
    protected $connection = 'geo_db';
    protected $table      = 'estados_municipios_localidades';

    public function scopeByEntidad($query, $cveEnt)
    {
        if (empty ($cveEnt)) {
            return;
        }

        $query->where('CVE_ENT', $cveEnt);
    }

    public function scopeByMunicipio($query, $cveMun)
    {
        if (empty ($cveMun)) {
            return;
        }

        $query->where('CVE_MUN', $cveMun);
    }

    public static function getEntidades()
    {
        return Inegi::groupBy('CVE_ENT', 'NOM_ENT')
            ->orderBy('NOM_ENT')
            ->get([ 'CVE_ENT', 'NOM_ENT' ]);
    }

    public static function getMunicipiosPorEntidad($cveEnt)
    {
        return Inegi::byEntidad($cveEnt)
            ->groupBy('CVE_ENT', 'CVE_MUN', 'NOM_MUN')
            ->orderBy('NOM_MUN')
            ->selectRaw('CVE_ENT, CVE_MUN as value, NOM_MUN as label')
            ->get();
    }

    public static function getLocalidadesPorMunicipio($cveEnt, $cveMun)
    {
        return Inegi::byEntidad($cveEnt)
            ->byMunicipio($cveMun)
            ->groupBy('CVE_ENT', 'CVE_MUN', 'CVE_LOC', 'NOM_LOC')
            ->orderBy('NOM_LOC')
            ->selectRaw('CVE_ENT,CVE_MUN,CVE_LOC as value,NOM_LOC as label')
            ->get();
    }
}
