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

class Localidad extends Model
{
    use Compoships;

    protected $connection   = 'geo_db';
    protected $table        = 'geodatabase.mun_loc_qroo_camp';
    protected $primaryKey   = NULL;
    public    $incrementing = NULL;

    public function planteles()
    {
        return $this->hasMany(Plantel::class, [ 'cve_ent', 'cve_mun', 'cve_loc' ], [ 'CVE_ENT', 'CVE_MUN', 'CVE_LOC' ]);
    }
}
