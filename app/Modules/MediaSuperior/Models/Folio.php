<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:31
 */

namespace ExamenEducacionMedia\Modules\MediaSuperior\Models;


use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $table    = 'folios';
    protected $fillable = [
        'folio', 'active',
    ];

    public static function getFolio(): Folio
    {
        return Folio::where('active', 1)->inRandomOrder()->firstOrFail();
    }

    public function desactivar()
    {
        $this->update([ 'active' => 0 ]);
    }
}
