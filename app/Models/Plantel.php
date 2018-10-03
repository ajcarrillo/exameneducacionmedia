<?php

namespace ExamenEducacionMedia\Models;

use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    protected $table = 'planteles';

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
