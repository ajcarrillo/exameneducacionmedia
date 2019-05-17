<?php

namespace Plantel\Http\Controllers;

use Aspirante\Repositories\AspiranteRepository;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Subsistema\Repositories\PlantelRepository;

class PanelController extends Controller
{
    private $repository;
    /**
     * @var PlantelRepository
     */
    private $plantelRepository;

    public function __construct(AspiranteRepository $repository, PlantelRepository $plantelRepository)
    {
        $this->repository        = $repository;
        $this->plantelRepository = $plantelRepository;
    }

    public function index()
    {
        $plantel = get_user()->plantel;
        $params  = [ 'plantel' => $plantel->id ];

        $stats = $this->plantelRepository->statsByPlantel($plantel->id);

        $total_oferta = $plantel->ofertaEducativa()->where('active', 1)->count();;
        $nombre_plantel              = $plantel->descripcion;
        $total_demanda               = $this->repository->aspirantesConSeleccion($params)->count();
        $aspirantes_proceso_completo = $this->repository->aspirantesConProcesoCompleto($params)->count();
        $aspirantes_sin_pago         = $this->repository->aspirantesConPagoPendiente($params)->count();
        $aspirantes_con_pago         = $this->repository->aspirantesConPago($params)->count();
        $aspirantes_sin_envio        = $this->repository->aspirantesSinEnvioRegistro($params)->count();
        $aforo_suma                  = $plantel->aulas()->groupBy('edificio_id')->sum('capacidad');
        $aulas                       = $plantel->aulas()->count();

        //TODRES: Implementar calculo de porcentaje y sedes alternas
        $porcentaje = 0;
        $sedes      = $plantel->sedesAlternas;


        return view('planteles.home', compact(
            'stats',
            'aulas',
            'sedes',
            'aforo_suma',
            'porcentaje',
            'total_oferta',
            'total_demanda',
            'nombre_plantel',
            'aspirantes_con_pago',
            'aspirantes_sin_pago',
            'aspirantes_sin_envio',
            'aspirantes_proceso_completo'
        ));
    }
}
