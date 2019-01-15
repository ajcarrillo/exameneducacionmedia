<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-11
 * Time: 13:51
 */

namespace Subsistema\Http\Controllers\API;


use Illuminate\Http\Request;
use Subsistema\Models\Especialidad;

class EspecialidadController extends BaseController
{
    public function index()
    {
        $this->setSubsistema();
        $especialidades = Especialidad::where('subsistema_id', $this->subsistema->id)
            ->orderBy('referencia')
            ->get();

        return ok(compact('especialidades'));
    }

    public function store(Request $request)
    {
        $this->setSubsistema();
        if ( ! Especialidad::where('referencia', trim($request->input('referencia')))->where('subsistema_id', $this->subsistema->id)->exists()) {

            $especialidad = new Especialidad($request->input());

            $this->subsistema->especialidades()->save($especialidad);

            return ok(compact('especialidad'));
        }

        return not_acceptable([], ['La especialidad ya exíste']);
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        //TODO: Verificar que no el nuevo nombre no exista en la base de datos
        $especialidad->update($request->input());

        return ok(compact('especialidad'));
    }

}
