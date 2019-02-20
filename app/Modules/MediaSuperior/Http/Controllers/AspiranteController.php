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
     * Mostrar expediente del aspirante
     *
     */
    public function show($id)
    {
        $aspirante = Aspirante::with(
            'user',
            'domicilio.localidad',
            'paisNacimiento',
            'informacionProcedencia',
            'opcionesEducativas.seleccionOferta',
            'revisiones.revision'
        )->find($id);

        $ofertas    = $aspirante->opcionesEducativas;
        $revisiones = $aspirante->revisiones;

        $conDomicilio = empty($aspirante->domicilio) ? false : true;
        $sexos      = Aspirante::listaSexos();
        $estados    = RevisionRegistro::listaEstadosPago();

        return view('administracion.aspirantes.show', compact('aspirante', 'ofertas', 'revisiones', 'conDomicilio', 'sexos', 'estados'));
    }

    /**
     * Update.
     *
     */
    public function update(Request $request, $id)
    {
        dd('hey... trabajando');
    }
}