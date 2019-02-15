<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-23
 * Time: 17:24
 */

namespace Aspirante\Http\Controllers\API;

use Aspirante\Http\Requests\UpdateAspirante;
use Aspirante\Traits\Utilities;
use ExamenEducacionMedia\Classes\Renapo;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateAspiranteController extends Controller
{
    use Utilities;

    public function update(UpdateAspirante $request, $id)
    {
        $request->validated();

        $aspirante = $this->getAspiranteByUuid($id);

        $aspiranteValidado = $this->validarCurp($request);

        $aspirante->update($aspiranteValidado);

        $data = [
            'aspirante' => $aspirante
        ];

        return ok($data);
    }

    protected function validarCurp(Request $request)
    {
        $aspirante = [
            'curp'                  => $request->input('curp'),
            'curp_historica'        => $request->input('curp_historica'),
            'curp_valida'           => $request->input('curp_valida'),
            'entidad_nacimiento_id' => $request->input('entidad_nacimiento_id'),
            'fecha_nacimiento'      => $request->input('fecha_nacimiento'),
            'nombre'                => $request->input('nombre'),
            'pais_nacimiento_id'    => $request->input('pais_nacimiento_id'),
            'primer_apellido'       => $request->input('primer_apellido'),
            'segundo_apellido'      => $request->input('segundo_apellido'),
            'sexo'                  => $request->input('sexo'),
            'telefono'              => $request->input('telefono'),
        ];

        if ($request->input('pais_nacimiento_id') !== 'MX') {
            return $aspirante;
        }


        $renapo = new Renapo();
        $curp   = $renapo->consultarCurp($request->input('curp'));

        if (is_null($curp['curp'])) {
            $aspirante['curp_historica'] = 0;
            $aspirante['curp_valida']    = 0;
        } else {
            if ($curp['es_historica']) {
                $aspirante['curp_historica'] = 1;
                $aspirante['curp_valida']    = 0;
            }
            if (! $curp['es_historica']) {
                $aspirante['curp_historica'] = 0;
                $aspirante['curp_valida']    = 1;
            }
        }

        return $aspirante;
    }
}
