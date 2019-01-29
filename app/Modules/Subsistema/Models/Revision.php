<?php

namespace ExamenEducacionMedia\Modules\Subsistema\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisiones';

    public function revision()
    {
        return $this->morphTo();
    }
}
