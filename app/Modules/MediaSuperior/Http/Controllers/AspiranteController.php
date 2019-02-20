<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-13
 * Time: 21:08
 */

namespace MediaSuperior\Http\Controllers;


use Aspirante\Models\Aspirante;
use Aspirante\Models\RevisionRegistro;
use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use ExamenEducacionMedia\UserFilter;
use Illuminate\Http\Request;
use MediaSuperior\Models\Revision;

class AspiranteController extends Controller
{
    public function index(Request $request, UserFilter $filters)
    {
        $users = User::query()
            ->with('aspirante')
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', [ 'supermario', 'cordinador', 'departamento',
                    'subsistema', 'plantel', 'invitado', ]);
            })
            ->filterBy($filters, $request->only([ 'search', 'curp' ]))
            ->paginate(50);

        $users->appends($request->only([ 'curp', 'search' ]));

        return view('administracion.aspirantes.index', compact('users'));
    }

    /**
     * Show
     * Mostrar expediente del aspirante
     */
    public function show($id)
    {
        $aspirante = Aspirante::with(
            'user',
            'domicilio.localidad',
            'paisNacimiento',
            'informacionProcedencia',
            'opcionesEducativas.seleccionOferta',
            'revision.revision'
        )->find($id);

        $ofertas  = $aspirante->opcionesEducativas;
        $revision = $aspirante->revision;

        $conDomicilio    = empty($aspirante->domicilio) ? false : true;
        $conRevision     = empty($aspirante->revision) ? false : true;
        $sexos           = Aspirante::listaSexos();
        $estadosPago     = RevisionRegistro::listaEstadosPago();

        return view('administracion.aspirantes.show', compact('aspirante', 'ofertas', 'revision', 'conDomicilio', 'conRevision', 'sexos', 'estadosPago'));
    }

    /**
     * Update.
     * Modificar los datos permitidos del aspirante.
     */
    public function update(Request $request, $id)
    {
        dd($request);
        $aspirante = Aspirante::find($id);
        $aspirante->update($request->only('curp', 'fecha_nacimiento', 'sexo'));

        $user = $aspirante->user;
        $user->update($request->user);

        $revision = $aspirante->revision;
        $revision->update($request->revision);

        flash('Los datos fueron modificados correctamente.')->success();
        return redirect()->back();
    }
}
