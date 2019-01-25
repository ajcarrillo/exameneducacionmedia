<?php

namespace ExamenEducacionMedia\Http\Controllers\API;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\Geodatabase\Localidad;

class LocalidadController extends Controller
{

    public function index()
    {
        $localidades = Localidad::where('CVE_ENT', 23)
            ->where('CVE_MUN', request('cve_mun'))
            ->selectRaw('CVE_ENT,CVE_MUN,CVE_LOC as value,NOM_LOC as label')
            ->get();

        return ok(compact('localidades'));
    }

    public function show()
    {
        $localidad = Localidad::where('CVE_ENT', 23)
            ->where('CVE_MUN', request('cve_mun'))
            ->where('CVE_LOC', request('cve_loc'))
            ->selectRaw('CVE_ENT,CVE_MUN,CVE_LOC as value,NOM_LOC as label')
            ->firstOrFail();

        return ok(compact('localidad'));
    }
}
