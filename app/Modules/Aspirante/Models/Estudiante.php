<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-16
 * Time: 21:15
 */

namespace Aspirante\Models;


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public    $incrementing = false;
    protected $table        = 'estudiantes';
    protected $primaryKey   = 'alumno_id';
}
