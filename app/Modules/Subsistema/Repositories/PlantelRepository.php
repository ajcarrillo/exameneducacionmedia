<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-02
 * Time: 21:14
 */

namespace Subsistema\Repositories;


use DB;
use ExamenEducacionMedia\Classes\BaseRepository;
use Subsistema\Models\Filters\PlantelFilter;
use Subsistema\Models\Plantel;

class PlantelRepository extends BaseRepository
{

    public function getModel()
    {
        return new Plantel();
    }

    public function planteles(array $params = [])
    {
        $query = $this->newQuery()
            ->filterBy(new PlantelFilter, $params)
            ->select('planteles.id', 'planteles.descripcion as plantel', 'subsistemas.referencia as subsistema')
            ->join('subsistemas', 'planteles.subsistema_id', '=', 'subsistemas.id')
            ->where('planteles.active', 1);

        return $query;
    }

    public function ofertaEducativa(array $params = [])
    {
        $query = $this->planteles($params)
            ->plantelesConMunicipioLocalidad()
            ->join('ofertas_educativas', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('oferta_educativa_grupos', 'ofertas_educativas.id', '=', 'oferta_educativa_grupos.oferta_educativa_id')
            ->join('especialidades', 'ofertas_educativas.especialidad_id', '=', 'especialidades.id')
            ->where('ofertas_educativas.active', 1)
            ->where('planteles.active', 1)
            ->addSelect(DB::raw('planteles.clave,geo.NOM_MUN AS municipio,geo.NOM_LOC AS localidad,especialidades.referencia as especialidad,oferta_educativa_grupos.grupos,oferta_educativa_grupos.alumnos,oferta_educativa_grupos.alumnos * oferta_educativa_grupos.grupos AS total'));

        return $query;
    }

    public function estadisticasPlantel()
    {
        $queryDemanda = $this->demanda()
            ->addSelect(DB::raw('planteles.id, count(planteles.id) as demanda'))
            ->groupBy('planteles.id');

        $queryOferta = $this->oferta()
            ->addSelect(DB::raw('planteles.id, sum((oferta_educativa_grupos.alumnos * oferta_educativa_grupos.grupos)) as oferta'))
            ->groupBy('planteles.id');

        $planteles = $this->planteles()
            ->leftJoin(DB::raw("({$queryDemanda->toSql()}) as plantel_demanda"), function ($join) {
                $join->on('planteles.id', '=', 'plantel_demanda.id');
            })
            ->leftJoin(DB::raw("({$queryOferta->toSql()}) as plantel_oferta"), function ($join) {
                $join->on('planteles.id', '=', 'plantel_oferta.id');
            })
            ->mergeBindings($queryOferta)
            ->mergeBindings($queryDemanda)
            ->addSelect(DB::raw('ifnull(plantel_demanda.demanda,0) as demanda,ifnull(plantel_oferta.oferta,0) as oferta, ifnull(floor((plantel_demanda.demanda*100)/plantel_oferta.oferta),0) as porcentaje'));

        return $planteles;
    }

    protected function demanda()
    {
        $query = DB::table('planteles')
            ->join('ofertas_educativas', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('seleccion_ofertas_educativas', function ($join) {
                $join->on('seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
                    ->where('seleccion_ofertas_educativas.preferencia', 1);
            });

        return $query;
    }

    protected function oferta()
    {
        $query = DB::table('planteles')
            ->join('ofertas_educativas', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('oferta_educativa_grupos', 'ofertas_educativas.id', '=', 'oferta_educativa_grupos.oferta_educativa_id')
            ->where('planteles.active', 1)
            ->where('ofertas_educativas.active', 1);

        return $query;
    }
}
