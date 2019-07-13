<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-07-13
 * Time: 13:35
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use Storage;

class DescargarReporteIndividualController extends Controller
{
    public function index()
    {
        $folio = get_aspirante()->folio;
        $file  = "{$folio}.pdf";

        try {
            return Storage::disk('reportes_individuales')->download($file);
        } catch (\Exception $e) {
            abort(404, 'Lo sentimos no se encontró el archivo solicitado');
        }
    }

}
