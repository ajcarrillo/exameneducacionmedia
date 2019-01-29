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

class SeleccionOfertaController extends Controller
{
    public function __invoke()
    {
        $municipios = $this->getMunicipios();
        $opciones = $this->getOpcionesEducativas();

        return view('aspirante.seleccion_oferta', compact('municipios', 'opciones'));
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
}
