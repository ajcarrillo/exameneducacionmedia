<?php

namespace ExamenEducacionMedia;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}
