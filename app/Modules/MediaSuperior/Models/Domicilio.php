<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:10
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Geodatabase\Localidad;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\SedeAlterna;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use Compoships;

    protected $connection = 'mysql';
    protected $table      = 'domicilios';
    protected $guarded    = [];

    public function sedeAlterna()
    {
        return $this->hasOne(SedeAlterna::class, 'domicilio_id');
    }

    public function municipio()
    {
        return $this->belongsTo(MunicipioView::class, [ 'cve_ent', 'cve_mun' ], [ 'CVE_ENT', 'CVE_MUN' ]);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, [ 'cve_ent', 'cve_mun', 'cve_loc' ], [ 'CVE_ENT', 'CVE_MUN', 'CVE_LOC' ]);
    }
}
