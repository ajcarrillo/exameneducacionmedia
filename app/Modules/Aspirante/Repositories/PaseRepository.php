<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-04-12
 * Time: 12:51
 */

namespace Aspirante\Repositories;


use Aspirante\Models\Pase;
use DB;
use ExamenEducacionMedia\Classes\BaseRepository;
use Subsistema\Repositories\PlantelRepository;

class PaseRepository extends BaseRepository
{

    public function getModel()
    {
        return new Pase();
    }

    public function pases()
    {
        return $this->newQuery();
    }

    public function monitoreo_aforo()
    {
        $aforo = $this->aforo();

        $query = $this->pases()
            ->join('aulas', function ($query) {
                $query->on('pases_examen.aula_id', '=', 'aulas.id')
                    ->whereRaw("edificio_type = 'plantel'");
            })
            ->join('planteles', 'aulas.edificio_id', '=', 'planteles.id')
            ->join(DB::raw("({$aforo->toSql()}) as aforo"), function ($query) {
                $query->on('planteles.id', '=', 'aforo.id');
            })
            ->select(
                'planteles.descripcion',
                DB::raw('count(planteles.id) as pases'),
                'aforo.aforo',
                DB::raw('round((count(planteles.id) / aforo.aforo) * 100) as porcentaje')
            )
            ->groupBy('planteles.id');

        return $query;
    }

    protected function aforo()
    {
        $plantelRepo = new PlantelRepository();

        return $plantelRepo->aforo();
    }
}
