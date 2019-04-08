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
use Subsistema\Models\Filters\PlantelesFilter;
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
            ->filterBy(new PlantelesFilter, $params)
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

    public function aspirantes_con_pase()
    {
        $query = DB::table('pases_examen')
            ->select('planteles.id', DB::raw('count(planteles.id) as proceso_completo'))
            ->join('aspirantes', 'pases_examen.aspirante_id', '=', 'aspirantes.id')
            ->conPrimeraOpcion()
            ->groupBy('planteles.id');

        return $query;
    }

    public function aspirantes_con_pago($conPago = true)
    {
        $query = DB::table('revision_registros')
            ->select('planteles.id', DB::raw('count(planteles.id) as con_pago'))
            ->join('aspirantes', function ($join) use ($conPago) {
                $join->on('revision_registros.aspirante_id', '=', 'aspirantes.id')
                    ->where('efectuado', $conPago);
            })
            ->conPrimeraOpcion()
            ->groupBy('planteles.id');

        return $query;
    }

    public function aspirantes_con_registro_sin_pago()
    {
        return $this->aspirantes_con_pago(false);
    }

    public function aspirantes_sin_registro()
    {
        $query = DB::table('aspirantes')
            ->select('planteles.id', DB::raw('count(planteles.id) as sin_registro'))
            ->leftJoin('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->conPrimeraOpcion()
            ->whereNull('revision_registros.id')
            ->groupBy('planteles.id');

        return $query;
    }

    public function getDemanda()
    {
        return $this->demanda()
            ->addSelect(DB::raw('planteles.id, count(planteles.id) as demanda'))
            ->groupBy('planteles.id');
    }

    public function getOferta()
    {
        $query = DB::table('planteles')
            ->addSelect(DB::raw('planteles.id, sum((oferta_educativa_grupos.alumnos * oferta_educativa_grupos.grupos)) as oferta'))
            ->join('ofertas_educativas', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->join('oferta_educativa_grupos', 'ofertas_educativas.id', '=', 'oferta_educativa_grupos.oferta_educativa_id')
            ->whereRaw('planteles.active = 1')
            ->whereRaw('ofertas_educativas.active = 1')
            ->groupBy('planteles.id');

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

    public function statsByPlantel($plantelId)
    {
        return DB::select($this->sqlEstadisticas(), [ $plantelId ]);
    }

    public function monitoreoPlanteles(array $params = [])
    {
        $sub                   = $this->aspirantes_con_pase();
        $aforo                 = $this->aforo();
        $oferta                = $this->getOferta();
        $demanda               = $this->getDemanda();
        $con_pago              = $this->aspirantes_con_pago();
        $sin_registro          = $this->aspirantes_sin_registro();
        $con_registro_sin_pago = $this->aspirantes_con_registro_sin_pago();

        $query = $this->planteles($params)
            ->plantelesConMunicipioLocalidad()
            ->leftJoin(DB::raw("({$sub->toSql()}) as aspirantes_con_pase"), function ($join) {
                $join->on('planteles.id', '=', 'aspirantes_con_pase.id');
            })
            ->leftJoin(DB::raw("({$con_pago->toSql()}) as aspirantes_con_pago"), function ($join) {
                $join->on('planteles.id', '=', 'aspirantes_con_pago.id');
            })
            ->leftJoin(DB::raw("({$sin_registro->toSql()}) as aspirantes_sin_registro"), function ($join) {
                $join->on('planteles.id', '=', 'aspirantes_sin_registro.id');
            })
            ->leftJoin(DB::raw("({$con_registro_sin_pago->toSql()}) as aspirantes_con_registro_sin_pago"), function ($join) {
                $join->on('planteles.id', '=', 'aspirantes_con_registro_sin_pago.id');
            })
            ->leftJoin(DB::raw("({$demanda->toSql()}) as demandas"), function ($join) {
                $join->on('planteles.id', '=', 'demandas.id');
            })
            ->leftJoin(DB::raw("({$oferta->toSql()}) as ofertas"), function ($join) {
                $join->on('planteles.id', '=', 'ofertas.id');
            })
            ->leftJoin(DB::raw("({$aforo->toSql()}) as aforos"), function ($join) {
                $join->on('planteles.id', '=', 'aforos.id');
            })
            ->addSelect('aspirantes_con_pase.proceso_completo')
            ->addSelect('aspirantes_con_pago.con_pago')
            ->addSelect('aspirantes_sin_registro.sin_registro')
            ->addSelect('aspirantes_con_registro_sin_pago.con_pago as con_registro_sin_pago')
            ->addSelect('demandas.demanda')
            ->addSelect('ofertas.oferta')
            ->addSelect('aforos.aforo')
            ->addSelect('geo.NOM_MUN as municipio')
            ->addSelect('subsistemas.id as subsistema_id')
            ->mergeBindings($sub)
            ->mergeBindings($con_pago)
            ->mergeBindings($sin_registro)
            ->mergeBindings($con_registro_sin_pago)
            ->mergeBindings($demanda)
            ->mergeBindings($oferta);

        return $query;
    }

    public function aforo()
    {
        return DB::table('aulas')
            ->select('planteles.id', DB::raw('sum(aulas.capacidad) as aforo'))
            ->join('planteles', 'aulas.edificio_id', '=', 'planteles.id')
            ->whereRaw('aulas.edificio_type="plantel"')
            ->groupBy('planteles.id');
    }

    protected function sqlEstadisticas()
    {
        return 'SELECT `planteles`.`id`,
`planteles`.`descripcion`                                                 AS `plantel`,
`subsistemas`.`referencia`                                                AS `subsistema`,
ifnull(plantel_demanda.demanda, 0)                                        AS demanda,
ifnull(plantel_oferta.oferta, 0)                                          AS oferta,
ifnull(floor((plantel_demanda.demanda * 100) / plantel_oferta.oferta), 0) AS porcentaje
FROM `planteles`
INNER JOIN `subsistemas` ON `planteles`.`subsistema_id` = `subsistemas`.`id`
LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS demanda
FROM `planteles`
INNER JOIN `ofertas_educativas` ON `planteles`.`id` = `ofertas_educativas`.`plantel_id`
INNER JOIN `seleccion_ofertas_educativas`
ON `seleccion_ofertas_educativas`.`oferta_educativa_id` = `ofertas_educativas`.`id` AND `seleccion_ofertas_educativas`.`preferencia` = 1
GROUP BY `planteles`.`id`) AS plantel_demanda ON `planteles`.`id` = `plantel_demanda`.`id`
LEFT JOIN (SELECT planteles.id,
sum((oferta_educativa_grupos.alumnos * oferta_educativa_grupos.grupos)) AS oferta
FROM `planteles`
INNER JOIN `ofertas_educativas` ON `planteles`.`id` = `ofertas_educativas`.`plantel_id`
INNER JOIN `oferta_educativa_grupos` ON `ofertas_educativas`.`id` = `oferta_educativa_grupos`.`oferta_educativa_id`
WHERE `planteles`.`active` = 1 AND `ofertas_educativas`.`active` = 1
GROUP BY `planteles`.`id`) AS plantel_oferta ON `planteles`.`id` = `plantel_oferta`.`id`
WHERE `planteles`.`id` = ? AND `planteles`.`active` = 1';
    }
}
