<?php

namespace ExamenEducacionMedia\Modules\Subsistema\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use MediaSuperior\Models\Revision;

class RevisionAforo extends Model
{
    use Compoships;
    protected $table="revision_aforos";
    protected $fillable = ['subsistema_id'];

    public function revision()
    {
        return $this->morphOne(Revision::class, 'revision');
    }
}
