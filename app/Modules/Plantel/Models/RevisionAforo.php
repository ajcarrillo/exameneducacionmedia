<?php

namespace ExamenEducacionMedia\Modules\Plantel\Models;


use Illuminate\Database\Eloquent\Model;
use MediaSuperior\Models\Revision;
use Plantel\Models\Subsistema;

class RevisionAforo extends Model
{
    protected $table="revision_aforos";
    protected $fillable = ['subsistema_id'];

    public function review()
    {
        return $this->morphOne(Revision::class, 'revision');
    }

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class,'subsistema_id');
    }
}
