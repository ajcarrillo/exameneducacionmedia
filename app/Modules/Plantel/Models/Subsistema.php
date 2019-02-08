<?php


namespace Plantel\Models;



use ExamenEducacionMedia\Modules\Plantel\Models\RevisionAforo;
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
        return $this->hasMany(RevisionOferta::class,'subsistema_id');
    }


}
