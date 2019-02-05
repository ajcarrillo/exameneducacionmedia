<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2018-12-19
 * Time: 23:57
 */

namespace MediaSuperior\Models;


use Awobaz\Compoships\Compoships;

use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    use Compoships;

    protected $connection = 'mysql';
    protected $table      = 'planteles';
    protected $guarded    = [];


}
