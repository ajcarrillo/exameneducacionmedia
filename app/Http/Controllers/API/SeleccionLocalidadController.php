<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-05
 * Time: 19:52
 */

namespace ExamenEducacionMedia\Http\Controllers\API;


use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\Geodatabase\Localidad;

class SeleccionLocalidadController extends Controller
{
    public function index()
    {
        $localidades = DB::table('geodatabase.mun_loc_qroo_camp as geo')
            ->selectRaw('geo.CVE_ENT, geo.CVE_MUN, geo.CVE_LOC as value, geo.NOM_LOC as label')
            ->join('educacionmedia.planteles as p', function ($join) {
                $join->on('geo.CVE_ENT', '=', 'p.cve_ent')
                    ->on('geo.CVE_MUN', '=', 'p.cve_mun')
                    ->on('geo.CVE_LOC', '=', 'p.cve_loc');
            })->where('geo.CVE_ENT', 23)
            ->where('geo.CVE_MUN', request('cve_mun'))
            ->groupBy([ 'geo.CVE_ENT', 'geo.CVE_MUN', 'geo.CVE_LOC' ])
            ->get();

        return ok(compact('localidades'));
    }
}
