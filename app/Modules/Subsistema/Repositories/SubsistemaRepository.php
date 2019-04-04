<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-04
 * Time: 01:08
 */

namespace Subsistema\Repositories;


use DB;
use ExamenEducacionMedia\Classes\BaseRepository;
use Subsistema\Models\Subsistema;

class SubsistemaRepository extends BaseRepository
{

    public function getModel()
    {
        return new Subsistema();
    }

    public function ofertaDemanda()
    {
        return DB::select('
        SELECT subsistemas.id,
substring(subsistemas.referencia,1,6) AS referencia,
oferta.oferta,
demanda.demanda
FROM subsistemas
INNER JOIN (SELECT subsistemas.id,
subsistemas.referencia,
count(subsistemas.id) demanda
FROM ofertas_educativas
INNER JOIN seleccion_ofertas_educativas ON ofertas_educativas.id = seleccion_ofertas_educativas.oferta_educativa_id AND preferencia = 1
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
INNER JOIN subsistemas ON planteles.subsistema_id = subsistemas.id
GROUP BY subsistemas.id
ORDER BY subsistemas.referencia) demanda ON subsistemas.id = demanda.id
INNER JOIN (SELECT subsistemas.id,
subsistemas.referencia,
sum(oferta_educativa_grupos.grupos * oferta_educativa_grupos.alumnos) oferta
FROM ofertas_educativas
INNER JOIN oferta_educativa_grupos ON ofertas_educativas.id = oferta_educativa_grupos.oferta_educativa_id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
INNER JOIN subsistemas ON planteles.subsistema_id = subsistemas.id
GROUP BY subsistemas.id
ORDER BY subsistemas.referencia) oferta ON subsistemas.id = oferta.id
ORDER BY subsistemas.referencia
        ');
    }
}
