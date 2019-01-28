<?php
/**
 * Created by PhpStorm.
 * User: alvaro
 * Date: 22/01/2019
 * Time: 12:52 PM
 */

namespace MediaSuperior\Models;


use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    public $table = 'revisiones';
    protected $guarded = [];

    public function revision()
    {
        return $this->morphTo();
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','usuario_apertura');
    }

}