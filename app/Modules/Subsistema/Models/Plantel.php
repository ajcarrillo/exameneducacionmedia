<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:57
 */

namespace Subsistema\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Models\Geodatabase\Localidad;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use ExamenEducacionMedia\QueryFilter;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    use Compoships;

    protected $connection = 'mysql';
    protected $table      = 'planteles';
    protected $guarded    = [];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }

    public function municipio()
    {
        return $this->belongsTo(MunicipioView::class, [ 'cve_ent', 'cve_mun' ], [ 'CVE_ENT', 'CVE_MUN' ]);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, [ 'cve_ent', 'cve_mun', 'cve_loc' ], [ 'CVE_ENT', 'CVE_MUN', 'CVE_LOC' ]);
    }

    public function ofertaEducativa()
    {
        return $this->hasMany(OfertaEducativa::class, 'plantel_id');
    }

    public function aulas()
    {
        return $this->morphMany(Aula::class, 'edificio');
    }

    public function scopeOnlyActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeFilterBy($query, QueryFilter $filters, array $data)
    {
        return $filters->applyTo($query, $data);
    }
}
