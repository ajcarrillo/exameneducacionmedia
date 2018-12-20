<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:57
 */

namespace Subsistema\Models;


use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class, 'subsistema_id');
    }
}
