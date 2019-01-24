<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:05
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Models\Entidad;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use ExamenEducacionMedia\Models\Geodatabase\Pais;

class ProfileController
{
    public function __invoke()
    {
        $aspirante = get_aspirante();

        $aspirante->loadMissing(
            'user', 'informacionProcedencia', 'domicilio',
            'paisNacimiento:id,descripcion', 'entidadNacimiento:id,descripcion'
        );

        $municipios = $this->getMunicipios();
        $entidades = $this->getEntidades();
        $paises     = $this->getPaises();


        return view('aspirante.profile', compact(
            'aspirante', 'municipios', 'paises', 'entidades'
        ));
    }

    protected function getMunicipios()
    {
        return MunicipioView::orderBy('NOM_MUN')->get();
    }

    protected function getEntidades()
    {
        return Entidad::select('id', 'descripcion')
            ->orderBy('id')
            ->get();
    }

    protected function getPaises()
    {
        return Pais::selectPaises();
    }
}
