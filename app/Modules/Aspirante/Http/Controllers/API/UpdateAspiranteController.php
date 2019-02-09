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

        $request = $this->validarCurp($request);

        $aspirante->update($request->input());

        $data = [
            'curp_historica' => $aspirante->curp_historica,
            'curp_valida'    => $aspirante->curp_valida,
        ];

        return ok($data);
    }

    protected function validarCurp(Request $request)
    {
        $renapo = new Renapo();
        $curp   = $renapo->consultarCurp($request->input('curp'));

        if (is_null($curp['curp'])) {
            $request->merge([ 'curp_historica' => 0 ]);
            $request->merge([ 'curp_valida' => 0 ]);
        } else {
            if ($curp['es_historica']) {
                $request->merge([ 'curp_historica' => 1 ]);
                $request->merge([ 'curp_valida' => 0 ]);
            }
            if (!$curp['es_historica']) {
                $request->merge([ 'curp_historica' => 0 ]);
                $request->merge([ 'curp_valida' => 1 ]);
            }
        }

        return $request;
    }
}
