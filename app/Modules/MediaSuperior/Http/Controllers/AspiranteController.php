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
use Exception;
use DB;

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

        $conDomicilio = empty($aspirante->domicilio) ? false : true;
        $conRevision  = empty($aspirante->revision) ? false : true;
        $sexos        = Aspirante::listaSexos();
        $estadosPago  = RevisionRegistro::listaEstadosPago();

        return view('administracion.aspirantes.show', compact('aspirante', 'ofertas', 'revision', 'conDomicilio', 'conRevision', 'sexos', 'estadosPago'));
    }

    /**
     * Update.
     * Modifica datos permitidos del aspirante y de la revision.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $aspirante = Aspirante::find($id);
            $aspirante->update($request->only('curp', 'fecha_nacimiento', 'sexo'));

            $user = $aspirante->user;
            $user->update($request->input('user'));

            $pass = $request->input('new_password');
            if (empty($pass)) {
            } else {
                $user->update([ 'password' => bcrypt($pass) ]);
            }

            if ($aspirante->revision()->exists()) {
                $efectuado = $request->input('revision.efectuado');
                $revision = $aspirante->revision;
                if ($revision->efectuado <> $efectuado) {
                    $revision->update([ 'efectuado' => $efectuado ]);

                    $registro = $aspirante->revision->revision;
                    $registro->update([
                        'fecha_revision'   => now(),
                        'usuario_revision' => \Auth::user()->id,
                    ]);
                }
            }

            DB::commit();
            flash('Los datos fueron modificados correctamente.')->success();

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            flash($e->getMessage())->warning();

            return redirect()->back();
        }
    }
}