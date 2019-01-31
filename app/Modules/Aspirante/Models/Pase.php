<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-27
 * Time: 17:06
 */

namespace Aspirante\Models;


use Illuminate\Database\Eloquent\Model;
use Subsistema\Models\Aula;

class Pase extends Model
{
    protected $table    = 'pases_examen';
    protected $fillable = [
        'numero_lista', 'automatico', 'aspirante_id', 'aula_id',
    ];

    public function aspirante()
    {
        return $this->belongsTo(Aspirante::class, 'aspirante_id');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
}
