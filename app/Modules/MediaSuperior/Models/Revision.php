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

    public function usuarioApertura()
    {
        return $this->belongsTo(User::class, 'usuario_apertura');
    }

    public function usuarioRevision()
    {
        return $this->belongsTo(User::class,'usuario_revision');
    }

}