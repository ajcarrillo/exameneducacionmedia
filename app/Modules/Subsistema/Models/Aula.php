<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:03
 */

namespace Subsistema\Models;


use Aspirante\Models\Pase;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table    = 'aulas';
    protected $fillable = [
        'referencia', 'capacidad',
    ];

    public function pasesAlExamen()
    {
        return $this->hasMany(Pase::class, 'aula_id');
    }

    public function totalPasesExamen()
    {
        return $this->pasesAlExamen()->count();
    }

    public function edificio()
    {
        return $this->morphTo();
    }

    public function setReferenciaAttribute($value)
    {
        $this->attributes['referencia'] = strtoupper($value);
    }
}
