<?php

namespace ExamenEducacionMedia\Models;

use ExamenEducacionMedia\Models\Geodatabase\Inegi;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table   = 'domicilios';
    protected $guarded = [];
    protected $appends = [ 'entidad', 'municipio', 'localidad' ];

    public function getEntidadAttribute(): Inegi
    {
        return Inegi::where('CVE_ENT', $this->cve_ent)
            ->groupBy('CVE_ENT', 'NOM_ENT')
            ->select('CVE_ENT', 'NOM_ENT')
            ->first();
    }

    public function getMunicipioAttribute(): Inegi
    {
        return Inegi::where('CVE_ENT', $this->cve_ent)
            ->where('CVE_MUN', $this->cve_mun)
            ->groupBy('CVE_ENT', 'CVE_MUN', 'NOM_MUN')
            ->select('CVE_ENT', 'CVE_MUN', 'NOM_MUN')
            ->first();
    }

    public function getLocalidadAttribute()
    {
        return Inegi::where('CVE_ENT', $this->cve_ent)
            ->where('CVE_MUN', $this->cve_mun)
            ->where('CVE_LOC', $this->cve_loc)
            ->select('CVE_ENT', 'CVE_MUN', 'CVE_LOC', 'NOM_LOC')
            ->first();
    }
}
