<?php
/**
 * Created by PhpStorm.
 * User: wsanchez
 * Date: 29/01/2019
 * Time: 11:26 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;


use ExamenEducacionMedia\Http\Controllers\Controller;

use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use ExamenEducacionMedia\Modules\MediaSuperior\Models\SedeAlterna;
use MediaSuperior\Models\Plantel;
use MediaSuperior\Models\Localidad;

class SedeAlternaController extends Controller
{
    public function index()
    {
        $sedes = SedeAlterna::get();

        return view('media_superior.administracion.sedesAlternas.index', compact('sedes'));
    }

    public function create()
    {
        $planteles = Plantel::pluck('descripcion', 'id');
        $municipios = $this->getMunicipios();
        $localidades   = $this->getLocalidades();

        return view('media_superior.administracion.sedesAlternas.create', compact('planteles', 'municipios', 'localidades'));
    }

    protected function getMunicipios()
    {
        return MunicipioView::where('CVE_ENT', 23)
            ->orderBy('NOM_MUN')
            ->pluck('NOM_MUN', 'CVE_MUN');
    }

    protected function getLocalidades()
    {
        return Localidad::where('CVE_ENT', 23)->where('CVE_MUN', '004')
                ->pluck('NOM_LOC', 'CVE_LOC');
    }

}