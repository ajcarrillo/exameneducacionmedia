<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-20
 * Time: 11:23
 */

namespace ExamenEducacionMedia\Models\Geodatabase;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Subsistema\Models\Plantel;

class MunicipioView extends Model
{
    use Compoships;

    public    $incrementing = NULL;
    //protected $connection   = 'geo_db';
    protected $table        = 'municipios_view';

    public function planteles()
    {
        return $this->hasMany(Plantel::class, [ 'cve_ent', 'cve_mun' ], [ 'CVE_ENT', 'CVE_MUN' ]);
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class, [ 'CVE_ENT', 'CVE_MUN' ], [ 'CVE_ENT', 'CVE_MUN' ]);
    }

}
