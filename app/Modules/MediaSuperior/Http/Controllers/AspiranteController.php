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
use Aspirante\Repositories\AspiranteRepository;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class AspiranteController extends Controller
{
    /**
     * @var AspiranteRepository
     */
    private $aspiranteRepository;

    public function __construct(AspiranteRepository $aspiranteRepository)
    {
        $this->aspiranteRepository = $aspiranteRepository;
    }

    public function index(Request $request)
    {
        $params = $request->only([ 'search' ]);

        $aspirantes = $this->aspiranteRepository->listarAspirantes($params)->paginate(50);

        $aspirantes->appends($params);

        return view('administracion.aspirantes.index', compact('aspirantes'));
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
                $revision  = $aspirante->revision;
                if ($revision->efectuado <> $efectuado) {
                    $revision->update([ 'efectuado' => $efectuado ]);

                    $registro = $aspirante->revision->revision;
                    $registro->update([
                        'fecha_revision'   => now(),
                        'usuario_revision' => \Auth::user()->id,
                        'comentario'       => $efectuado ? 'CONDONADO' : '',
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
