<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 00:01
 */

namespace Aspirante\Repositories;


use Aspirante\Models\Aspirante;
use Aspirante\Models\Filters\AspiranteFilters;
use DB;
use ExamenEducacionMedia\Classes\BaseRepository;

class AspiranteRepository extends BaseRepository
{

    public function getModel()
    {
        return new Aspirante();
    }

    public function listarAspirantesPorPlantel($plantel, array $params = [])
    {
        $query = $this->listarAspirantes($params);

        $query->join('seleccion_ofertas_educativas', function ($join) {
            $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                ->where('seleccion_ofertas_educativas.preferencia', '=', 1);
        })->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
            ->where('ofertas_educativas.plantel_id', $plantel);

        return $query;
    }

    public function listarAspirantes(array $params = [])
    {
        $query = $this->newQuery()
            ->join('users', 'aspirantes.user_id', '=', 'users.id')
            ->filterBy(new AspiranteFilters, $params)
            ->select(
                'aspirantes.id', DB::raw('users.id as user_id'), 'aspirantes.folio', 'users.uuid',
                'aspirantes.curp', 'aspirantes.matricula', 'users.email',
                DB::raw("UPPER(concat_ws(' ', nombre, primer_apellido, segundo_apellido)) as nombre_completo")
            );

        return $query;
    }
}
