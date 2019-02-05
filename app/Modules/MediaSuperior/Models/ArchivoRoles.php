<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 31/01/2019
 * Time: 11:26 PM
 */

namespace MediaSuperior\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ArchivoRoles extends Model
{
    protected $table = 'archivo_roles';
    protected $fillable = ['id','archivo_id','role_id' ];
    public function roles(){
        return $this->belongsToMany(Role::class,'roles')->withPivot('role_id','name');
    }

}