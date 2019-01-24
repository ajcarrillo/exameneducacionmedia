<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:30
 */

namespace ExamenEducacionMedia\Models;


use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use Compoships;

    public    $incrementing = false;
    protected $connection   = 'mysql';
    protected $table        = 'entidades';
    protected $primaryKey   = 'id';
}
