<?php


namespace Coordinacion\Http\Controllers;


use Aspirante\Repositories\RevisionRegistroRepository;
use ExamenEducacionMedia\Http\Controllers\Controller;

class PagosController extends Controller
{
    /**
     * @var RevisionRegistroRepository
     */
    private $registroRepository;

    public function __construct(RevisionRegistroRepository $registroRepository)
    {
        $this->registroRepository = $registroRepository;
    }

    public function index()
    {
        $total          = $this->registroRepository->revisiones()->count();
        $monto_total    = $this->registroRepository->montoTotal();
        $pagadas        = $this->registroRepository->pagadas()->count();
        $monto_pagadas  = $this->registroRepository->montoPagadas();
        $sinPago        = $this->registroRepository->sinPago()->count();
        $monto_sin_pago = $this->registroRepository->montoSinPago();

        $datos = [
            'monto_total'          => $monto_total,
            'monto_pagadas'        => $monto_pagadas,
            'total'                => $total,
            'monto_sin_pago'       => $monto_sin_pago,
            'solicitudes_sin_pago' => $sinPago,
            'solicitudes_pagadas'  => $pagadas,
        ];

        return $datos;
    }
}
