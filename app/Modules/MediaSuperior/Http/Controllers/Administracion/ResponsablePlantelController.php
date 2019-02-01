<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 28/01/2019
 * Time: 10:15 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use MediaSuperior\Models\Planteles;
use Subsistema\Models\Plantel;
use DB;

class ResponsablePlantelController extends Controller
{
    public function index()
    {
        $planteles = Plantel::with('subsistema', 'responsable')->get();

        return view('media_superior.administracion.responsablePlantel.index', compact('planteles'));
    }

    public function edit(Plantel $plantel)
    {
        return view('media_superior.administracion.responsablePlantel.asignar_responsable', compact('plantel'));
    }

    public function store(Request $request, Plantel $plantel)
    {



        try {
            DB::beginTransaction();
            $user    = User::where('email', '=', $request->input('email'))->first();
            $plantel = Plantel::find($plantel->id);
            if ($user != NULL) {
                $plantel->responsable_id = $user->id;
                $plantel->save();
                $user->assignRole('plantel');
                flash('Se asigno correctamente el responsable del plantel')->success();

                return redirect()->to(route('media.administracion.responsablePlantel.index'));
            }
            $data                    = [
                'nombre'           => $request->input('nombre'),
                'primer_apellido'  => $request->input('primer_apellido'),
                'segundo_apellido' => $request->input('segundo_apellido'),
                'email'            => $request->input('email'),
                'username'         => $request->input('username'),
                'password'         => bcrypt($request->input('password')),
                'api_token'        => str_random(50),
                'active'           => true,
            ];
            $new_user                       = User::createUser($data, [ 'plantel' ]);
            $plantel->responsable_id = $new_user->id;
            $plantel->save();
            DB::commit();
            flash('Se asigno correctamente el responsable del plantel')->success();

            return redirect()->to(route('media.administracion.responsablePlantel.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            flash('Lo sentimos hemos hecho algo mal, intente de nuevo')->error();

            return back()
                ->withErrors([ 'error' => 'Ocurrió un error en el guardado, por favor intentelo nuevamente, más tarde. ' ])
                ->withInput();
        }
    }

    public function Actualiza_responsable(Plantel $plantel)
    {
        $responsable = Plantel::with('responsable')->find($plantel->id);

        return view('media_superior.administracion.responsablePlantel.actualizar_responsable', compact('responsable'));
    }

    public function set_responsable(Request $request, Plantel $plantel)
    {
        try {
            DB::beginTransaction();
            $plantel = Plantel::with('responsable')->first();
            $user    = User::find($plantel->responsable->id);
            $data    = [
                'nombre'           => $request->input('nombre'),
                'primer_apellido'  => $request->input('primer_apellido'),
                'segundo_apellido' => $request->input('segundo_apellido'),
                'email'            => $request->input('email'),
                'username'         => $request->input('username'),
                'password'         => bcrypt($request->input('password')),
                'api_token'        => str_random(50),
                'active'           => true,
            ];
            $u       = User::actualizarUsuario($user, $data);
            DB::commit();
            flash('El responsable se actualizo correctamente')->success();

            return redirect()->to(route('media.administracion.responsablePlantel.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            flash('Lo sentimos hemos hecho algo mal, intente de nuevo')->error();

            return back()
                ->withErrors([ 'error' => 'Ocurrió un error en el guardado, por favor intentelo nuevamente, más tarde. ' ])
                ->withInput();
        }
    }

    public function delete_responsable(Plantel $plantel)
    {
        $plantel                 = Plantel::find($plantel->id);
        $plantel->responsable_id = NULL;
        $plantel->save();
        flash('Se elimino correctamente')->success();

        return redirect()->to(route('media.administracion.responsablePlantel.index'));
    }

    public function descuentos($id)
    {
        $planteles = Plantel::find($id);
        return view('media_superior.administracion.responsablePlantel.asignar_descuento', compact('planteles'));
    }

    public function updatedesc(Request $request, $id)
    {
        $planteles = Plantel::find($id);
        $planteles->descuento = $request->get('descuento');
        $planteles->opciones = $request->get('opciones');
        $planteles->save();

        return redirect('administracion/responsablePlantel');
    }
}