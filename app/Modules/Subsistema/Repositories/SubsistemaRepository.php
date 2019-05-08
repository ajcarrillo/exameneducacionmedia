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

    public function demandaGral()
    {
        return DB::select('SELECT p.id,
       p.cve_mun,
       p.nombre_municipio,
       s.id                                   subsistema_id,
       s.referencia                           subsistema,
       p.descripcion,
       ifnull(t_pases_examen.pases_examen, 0) pases_examen,
       ifnull(t_demanda.demanda, 0)           demanda,
       ifnull(t_por_pagar.por_pagar, 0)       por_pagar,
       ifnull(t_oferta.oferta, 0)             oferta
FROM planteles p
    INNER JOIN subsistemas s ON p.subsistema_id = s.id
    LEFT JOIN (SELECT plantel_id,
                      count(plantel_id) pases_examen
               FROM pases_examen pe
                   INNER JOIN aspirantes a ON pe.aspirante_id = a.id
                   INNER JOIN seleccion_ofertas_educativas soe ON a.id = soe.aspirante_id AND preferencia = 1
                   INNER JOIN ofertas_educativas oe ON soe.oferta_educativa_id = oe.id
               GROUP BY plantel_id) t_pases_examen ON p.id = t_pases_examen.plantel_id
    LEFT JOIN (SELECT plantel_id,
                      count(plantel_id) demanda
               FROM aspirantes a
                   INNER JOIN seleccion_ofertas_educativas soe ON a.id = soe.aspirante_id AND preferencia = 1
                   INNER JOIN ofertas_educativas oe ON soe.oferta_educativa_id = oe.id
               GROUP BY plantel_id) t_demanda ON p.id = t_demanda.plantel_id
    LEFT JOIN (SELECT plantel_id,
                      count(plantel_id) por_pagar
               FROM aspirantes a
                   INNER JOIN seleccion_ofertas_educativas soe ON a.id = soe.aspirante_id AND preferencia = 1
                   INNER JOIN ofertas_educativas oe ON soe.oferta_educativa_id = oe.id
                   INNER JOIN revision_registros rr ON a.id = rr.aspirante_id AND efectuado = 0
               GROUP BY plantel_id) t_por_pagar ON p.id = t_por_pagar.plantel_id
    LEFT JOIN (SELECT plantel_id,
                      sum(alumnos * grupos) oferta
               FROM planteles p
                   INNER JOIN ofertas_educativas oe ON p.id = oe.plantel_id
                   INNER JOIN oferta_educativa_grupos oeg ON oe.id = oeg.oferta_educativa_id
               GROUP BY plantel_id) t_oferta ON p.id = t_oferta.plantel_id
ORDER BY nombre_municipio, subsistema, p.descripcion;');
    }
}
