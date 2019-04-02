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

    public function aspirantesConSeleccion(array $params = [])
    {
        $query = $this->listarAspirantes($params);

        $query->join('seleccion_ofertas_educativas', function ($join) {
            $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                ->where('seleccion_ofertas_educativas.preferencia', '=', 1);
        })
            ->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
            ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id')
            ->join('subsistemas', 'planteles.subsistema_id', '=', 'subsistemas.id');

        return $query;
    }

    public function aspirantesConProcesoCompleto(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('pases_examen', 'aspirantes.id', '=', 'pases_examen.aspirante_id');

        return $query;
    }

    public function aspirantesConPagoPendiente(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->where('efectuado', 0);

        return $query;
    }

    public function aspirantesSinEnvioRegistro(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->leftJoin('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->whereNull('revision_registros.id');

        return $query;
    }

    public function aspirantesConPago(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->where('efectuado', 1);

        return $query;
    }
}
