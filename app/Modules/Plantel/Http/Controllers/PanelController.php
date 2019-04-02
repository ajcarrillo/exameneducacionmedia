<?php

namespace Plantel\Http\Controllers;

use Aspirante\Repositories\AspiranteRepository;
use ExamenEducacionMedia\Http\Controllers\Controller;

class PanelController extends Controller
{
    private $repository;

    public function __construct(AspiranteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $plantel = get_user()->plantel;
        $params  = [ 'plantel' => $plantel->id ];

        $total_oferta                = $plantel->ofertaEducativa()->where('active', 1)->count();
        $nombre_plantel              = $plantel->descripcion;
        $total_demanda               = $this->repository->aspirantesConSeleccion($params)->count();
        $aspirantes_proceso_completo = $this->repository->aspirantesConProcesoCompleto($params)->count();
        $aspirantes_sin_pago         = $this->repository->aspirantesConPagoPendiente($params)->count();
        $aspirantes_con_pago         = $this->repository->aspirantesConPago($params)->count();
        $aspirantes_sin_envio        = $this->repository->aspirantesSinEnvioRegistro($params)->count();
        $aforo_suma                  = $plantel->aulas()->groupBy('edificio_id')->sum('capacidad');
        $aulas                       = $plantel->aulas()->count();

        //TODRES: Implementar calculo de porcentaje y sedes alternas
        $porcentaje                  = 0;
        $sedes                       = '';


        return view('planteles.home', compact(
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
