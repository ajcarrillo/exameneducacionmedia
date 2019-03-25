<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:55
 */

namespace Subsistema\Models;


use ExamenEducacionMedia\Modules\Subsistema\Models\RevisionAforo;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Subsistema extends Model
{


    protected $table = 'subsistemas';

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function planteles()
    {
        return $this->hasMany(Plantel::class, 'subsistema_id');
    }

    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'subsistema_id');
    }

    public function revisionAforos()
    {
        return $this->hasMany(RevisionAforo::class, 'subsistema_id');
    }

    public function revisiones()
    {
        return $this->hasMany(RevisionOferta::class, 'subsistema_id');
    }

    public static function getSubsistemas()
    {
        return static::orderBy('referencia')
            ->get([ 'id', 'referencia' ]);
    }

}
