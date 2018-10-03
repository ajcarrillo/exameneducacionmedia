<?php

namespace ExamenEducacionMedia\Models;

use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Subsistema extends Model
{
    protected $table = 'subsistemas';

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
