<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function descargar(Request $request)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');

        $aspirantes = Aspirante::with('informacionProcedencia', 'opcionesEducativas', 'user')
            ->orderBy('informacionProcedencia.cct')
            ->orderBy('user.nombre')
            ->get();

        $formato = $request->formato;
        switch ($formato) {
            case 'listado-primera-opcion-secundaria':
                $pdf->loadView('administracion.reportes.aspirantes-1opc-sec', compact('aspirantes'));
                break;
        }

        return $pdf->download($formato . '.pdf');
    }
}