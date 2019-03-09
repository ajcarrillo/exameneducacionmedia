<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 10:35
 */

namespace Aspirante\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use MediaSuperior\Models\Revision;

class RevisionRegistro extends Model
{

    protected $table   = 'revision_registros';
    protected $guarded = [];
    protected $casts   = [
        'efectuado' => 'boolean',
    ];

    public function aspirante()
    {
        return $this->belongsTo(Aspirante::class, 'aspirante_id');
    }

    public function revision()
    {
        return $this->morphOne(Revision::class, 'revision');
    }

    public function crearRevision()
    {
        $revision = new Revision([
            'fecha_apertura'   => Carbon::now(),
            'estado'           => 'R',
            'usuario_apertura' => \Auth::user()->id,
        ]);

        $this->revision()->save($revision);
    }

    public static function listaEstadosPago()
    {
        $estados = [
            1 => 'Si',
            0 => 'No'
        ];

        return $estados;
    }
}
