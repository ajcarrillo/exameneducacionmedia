<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 04/02/2019
 * Time: 04:30 AM
 */

namespace MediaSuperior\Models;

use Illuminate\Database\Eloquent\Model;
class Aula extends Model
{
    protected $table    = 'aulas';
    protected $fillable = [
        'referencia', 'capacidad',
    ];

    public function edificio()
    {
        return $this->morphTo();
    }


}