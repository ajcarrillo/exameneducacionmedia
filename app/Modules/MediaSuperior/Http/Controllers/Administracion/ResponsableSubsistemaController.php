<?php
/**
 * Created by PhpStorm.
 * User: abalamjimenez
 * Date: 01/02/2019
 * Time: 00:35 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Subsistema\Models\Subsistema;
use DB;

class ResponsableSubsistemaController extends Controller
{
    public function index()
    {
        $subsistemas = Subsistema::with('responsable')->get();

        return view('media_superior.administracion.responsableSubsistema.index', compact('subsistemas'));
    }

    public function edit(Subsistema $subsistema)
    {
        $usuariosDisponibles = DB::table('educacionmedia.users','educacionmedia.planteles','educacionmedia.model_has_roles' )
            ->select('usuario.id',DB::raw("concat(usuario.nombre ,' ', usuario.primer_apellido ,' ', usuario.segundo_apellido) as nombreCompleto"),'usuario.email')
            ->from('educacionmedia.users as usuario')
            ->join('educacionmedia.model_has_roles AS rol', function ($join)
            {
                $join->on('rol.model_id','=','usuario.id')
                    ->where('rol.role_id','=','4');
            })
            ->leftJoin('educacionmedia.subsistemas as subsistema','subsistema.responsable_id','=','usuario.id')
            ->whereRaw( 'isnull(subsistema.id) ')->pluck('nombreCompleto','usuario.id');

        $responsable = Subsistema::with('responsable')->find($subsistema->id);

        return view('media_superior.administracion.responsableSubsistema.asignar_responsables', compact('subsistema','responsable','usuariosDisponibles'));
    }

    public function asigna_responsable_existente(Request $request,Subsistema $subsistema)
    {
        $user    = User::where('id', '=', $request->input('user_id'))->first();
        $subsistema = Subsistema::find($subsistema->id);
        $subsistema->responsable_id = $user->id;
        $subsistema->save();

        flash('Se actualizó correctamente el responsable del subsistema')->success();

        return redirect()->to(route('media.administracion.responsableSubsistema.subsistema.edit',$subsistema));
    }

    public function delete_responsable(Subsistema $subsistema)
    {
        $subsistema                 = Subsistema::find($subsistema->id);
        $subsistema->responsable_id = NULL;
        $subsistema->save();
        flash('El subsistema se  ha quedado sin responsable')->success();

        return redirect()->to(route('media.administracion.responsableSubsistema.subsistema.edit',$subsistema));
    }

    public function store(Request $request, Subsistema $subsistema)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', '=', $request->input('email'))->first();

            $subsistema = Subsistema::find($subsistema->id);

            if ($user != NULL) {

                $subsistema->responsable_id = $user->id;
                $subsistema->save();

                $user->assignRole('subsistema');

                flash('Se asigno correctamente el responsable del subsistema')->success();

                return redirect()->to(route('media.administracion.responsableSubsistema.subsistema.edit',$subsistema));
            }
            $data = [
                'nombre'           => $request->input('nombre'),
                'primer_apellido'  => $request->input('primer_apellido'),
                'segundo_apellido' => $request->input('segundo_apellido'),
                'email'            => $request->input('email'),
                'username'         => $request->input('email'),
                'password'         => $request->input('password'),
                'api_token'        => str_random(50),
                'active'           => true,
            ];
            $new_user = User::createUser($data, ['subsistema']);

            $subsistema->responsable_id = $new_user->id;
            $subsistema->save();

            DB::commit();

            flash('Se asigno correctamente el responsable del subsistema')->success();

            return redirect()->to(route('media.administracion.responsableSubsistema.subsistema.edit',$subsistema));

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            flash('Lo sentimos hemos hecho algo mal, intente de nuevo')->error();

            return back()
                ->withErrors(['error' => 'Ocurrió un error en el guardado, por favor intentelo nuevamente, más tarde. '])
                ->withInput();
        }
    }
}
