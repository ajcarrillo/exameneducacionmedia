<?php
/**
 * Created by PhpStorm.
 * User: alvaro
 * Date: 22/01/2019
 * Time: 12:52 PM
 */

namespace Subsistema\Models;


use Illuminate\Database\Eloquent\Model;
use MediaSuperior\Models\Revision;

class RevisionOferta extends Model
{
    public $table = 'revision_ofertas';
    protected $guarded = [];

    public function review()
    {
        return $this->morphMany(Revision::class,'revision');
    }

    public function subsistema()
    {
        return $this->belongsTo(Subsistema::class,'subsistema_id');
    }

}