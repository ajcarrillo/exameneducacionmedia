<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-28
 * Time: 22:28
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use Subsistema\Models\Plantel;

class SeleccionOfertaController extends Controller
{
    public function __invoke()
    {
        $municipios = $this->getMunicipios();
        $opciones   = $this->getOpcionesEducativas();
        $planteles  = $this->getPlanteles();

        return view('aspirante.seleccion_oferta', compact('municipios', 'opciones', 'planteles'));
    }

    protected function getMunicipios()
    {
        return MunicipioView::where('CVE_ENT', 23)
            ->orderBy('NOM_MUN')
            ->get([ 'CVE_MUN', 'NOM_MUN' ]);
    }

    protected function getOpcionesEducativas()
    {
        $aspirante = get_aspirante();

        return $aspirante->opcionesEducativas;
    }

    protected function getPlanteles()
    {
        return Plantel::orderBy('cve_mun', 'asc')
            ->orderBy('cve_loc', 'asc')
            ->orderBy('descripcion', 'asc')
            ->get();
    }
}
