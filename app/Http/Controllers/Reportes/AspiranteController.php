<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-05-01
 * Time: 12:44
 */

namespace ExamenEducacionMedia\Http\Controllers\Reportes;


use ExamenEducacionMedia\Exports\AspirantesViewExports;
use ExamenEducacionMedia\Exports\ListadoGeneralSMLPViewExports;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;

class AspiranteController extends Controller
{
    public function export(Excel $excel, AspirantesViewExports $export)
    {
        return $excel->download($export, 'aspirantes.xlsx');
    }

    public function listadoGeneralSMLP(Excel $excel, ListadoGeneralSMLPViewExports $export)
    {
        return $excel->download($export, 'listado_general_por_subsistema_municipio_localidad_plantel.xlsx');
    }
}
