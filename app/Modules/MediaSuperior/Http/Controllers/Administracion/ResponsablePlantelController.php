<?php
/**
 * Created by PhpStorm.
 * User: Mini
 * Date: 28/01/2019
 * Time: 10:15 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;
use ExamenEducacionMedia\Modules\MediaSuperior\Filters\SubsistemaFilter;
use ExamenEducacionMedia\User;
use Illuminate\Http\Request;
use MediaSuperior\Models\Planteles;
use Subsistema\Models\Plantel;
use DB;
use Subsistema\Models\Subsistema;

class ResponsablePlantelController extends Controller
{
    public function index()

    {

        $subsistemas = Subsistema::pluck('referencia', 'id');
        $planteles = Plantel::with('subsistema', 'responsable')->get();

        return view('media_superior.administracion.responsablePlantel.responsables.index', compact('planteles', 'subsistemas'));
    }
    public function edit(Plantel $plantel)
    {
        //$user = User::role('plantel')->get();
        //$plantel1 = Plantel::with('responsables')
        //whereNotIn('responsable_id','=',$user->id);
        //dd($plantel1);
        $qry = DB::table('educacionmedia.users','educacionmedia.planteles','educacionmedia.model_has_roles' )
            ->select('usuario.id',DB::raw("concat(usuario.nombre ,' ', usuario.primer_apellido ,' ', usuario.segundo_apellido) as nombreCompleto"),'usuario.username')
            ->from('educacionmedia.users as usuario')
            ->join('educacionmedia.model_has_roles  as rol','rol.model_id','=','usuario.id')
            ->leftJoin('educacionmedia.planteles as plantel','plantel.responsable_id','=','usuario.id')
            ->whereRaw( 'isnull (plantel.id) AND rol.role_id = 5 ')->pluck('nombreCompleto','usuario.id');
        $responsable = Plantel::with('responsable')->find($plantel->id);
        return view('media_superior.administracion.responsablePlantel.responsables.asignar_responsables', compact('plantel','responsable','qry'));
    }
    public function store(Request $request, Plantel $plantel)
    {
        try {
            DB::beginTransaction();
            $user = User::where('email', '=', $request->input('email'))->first();
            $plantel = Plantel::find($plantel->id);
            if ($user != NULL) {
                $plantel->responsable_id = $user->id;
                $plantel->save();
                $user->assignRole('plantel');
                flash('Se asigno correctamente el responsable del plantel')->success();
                return redirect()->to(route('media.administracion.responsablePlantel.plantel.edit',$plantel));
            }
            $data = [
                'nombre' => $request->input('nombre'),
                'primer_apellido' => $request->input('primer_apellido'),
                'segundo_apellido' => $request->input('segundo_apellido'),
                'email' => $request->input('email'),
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'api_token' => str_random(50),
                'active' => true,
            ];


            $new_user = User::createUser($data, ['plantel']);
            $plantel->responsable_id = $new_user->id;
            $plantel->save();
            DB::commit();
            flash('Se asigno correctamente el responsable del plantel')->success();
            return redirect()->to(route('media.administracion.responsablePlantel.plantel.edit',$plantel));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e->getMessage());
            flash('Lo sentimos hemos hecho algo mal, intente de nuevo')->error();

            return back()
                ->withErrors(['error' => 'Ocurrió un error en el guardado, por favor intentelo nuevamente, más tarde. '])
                ->withInput();
        }
    }
    public function asigna_responsable_existente(Request $request,Plantel $plantel)
    {

        $user    = User::where('id', '=', $request->input('user_id'))->first();
        $plantel = Plantel::find($plantel->id);
        $plantel->responsable_id = $user->id;
        $plantel->save();
        flash('Se actualizo correctamente el responsable del plantel')->success();
        return redirect()->back();
    }
    public function delete_responsable(Plantel $plantel)
    {
        $plantel = Plantel::find($plantel->id);
        $plantel->responsable_id = NULL;
        $plantel->save();
        flash('El plantel se  ha quedado sin responsable')->success();

        return redirect()->to(route('media.administracion.responsablePlantel.plantel.edit',$plantel));
    }
    public function descuentos($id)
    {
        /*$planteles = Plantel::find($id);
        $planteles->descuento = $request->get('descuento');
        $planteles->opciones = $request->get('opciones');
        $planteles->save();*/

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