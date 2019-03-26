<?php

namespace MediaSuperior\Http\Controllers;

use Aspirante\Models\Aspirante;
use ExamenEducacionMedia\Exports\AlumnosExports;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * @param Request $request
     */
    public function descargar(Request $request)
    {
        $formato = $request->formato;
        $tipo    = strtolower($request->tipo);
        switch ($formato) {
            case 'listado-primera-opcion-secundaria':
                switch ($tipo) {
                    case 'pdf':
                        return $this->downloadPdf($formato);
                        break;
                    case 'csv':
                        return $this->downloadCsv($formato);
                        break;
                    default :
                        return $this->downloadPdf($formato);
                }
                break;
            default:
                abort(404, 'el reporte solicitado no existe');
        }
    }

    private function downloadPdf($formato)
    {
        $pdf = app('snappy.pdf.wrapper');
        $pdf->setPaper('letter')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', '0mm')
            ->setOption('margin-top', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('disable-smart-shrinking', true)
            ->setOption('zoom', '1');

        $aspirantes = Aspirante::dataForAspirantes1erOp();

        $pdf->loadView('administracion.reportes.aspirantes-1opc-sec', compact('aspirantes'));

        return $pdf->download($formato . '.pdf');
    }

    private function downloadCsv($formato)
    {
        return \Excel::download(new AlumnosExports($formato), $formato . '.csv');
    }
}