<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 13:05
 */

namespace Aspirante\Http\Controllers;


use ExamenEducacionMedia\Classes\Renapo;
use ExamenEducacionMedia\Models\Entidad;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use Aspirante\Models\Seleccion;

class ProfileController
{
    public function __invoke()
    {
        $aspirante = get_aspirante();

        $aspirante = $this->validarCurp($aspirante);

        $aspirante->loadMissing(
            'user',
            'informacionProcedencia',
            'domicilio',
            'paisNacimiento:id,descripcion',
            'entidadNacimiento:id,descripcion'
        );

        $municipios = $this->getMunicipios();
        $entidades  = $this->getEntidades();
        $paises     = $this->getPaises();


        return view('aspirante.profile', compact('aspirante', 'municipios', 'paises', 'entidades'));
    }

    public static function validarCurp($aspirante)
    {
        if (!is_null($aspirante->curp) && !empty($aspirante->curp)) {
            if (is_null($aspirante->curp_historica) && is_null($aspirante->curp_valida)) {
                $renapo = new Renapo();
                $curp   = $renapo->consultarCurp($aspirante->curp);

                if (is_null($curp['curp'])) {
                    $aspirante->curp_historica = 0;
                    $aspirante->curp_valida    = 0;
                } else {
                    if ($curp['es_historica']) {
                        $aspirante->curp_historica = 1;
                        $aspirante->curp_valida    = 0;
                    }
                    if (!$curp['es_historica']) {
                        $aspirante->curp_historica = 0;
                        $aspirante->curp_valida    = 1;
                    }
                }

                $aspirante->save();
            }
        }


        return $aspirante;
    }


    protected function getMunicipios()
    {
        return MunicipioView::orderBy('NOM_MUN')
            ->where('cve_ent', 23)
            ->get();
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
