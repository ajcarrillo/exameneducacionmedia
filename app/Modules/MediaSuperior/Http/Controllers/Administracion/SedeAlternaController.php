<?php
/**
 * Created by PhpStorm.
 * User: wsanchez
 * Date: 29/01/2019
 * Time: 11:26 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use Aspirante\Models\Domicilio;
use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;

use ExamenEducacionMedia\Models\Geodatabase\Localidad;
use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;

use Illuminate\Http\Request;
use Subsistema\Models\Aula;
use Subsistema\Models\Plantel;
use Subsistema\Models\SedeAlterna;

class SedeAlternaController extends Controller
{
    public function index()
    {
        $sedes = DB::table('sedes_alternas')
            ->Join('domicilios', 'sedes_alternas.domicilio_id', '=', 'domicilios.id')
            ->leftJoin('geodatabase.municipios_view', 'domicilios.cve_mun', '=', 'geodatabase.municipios_view.CVE_MUN')
            ->Join('planteles', 'sedes_alternas.plantel_id', '=', 'planteles.id')
            ->select('sedes_alternas.*', 'geodatabase.municipios_view.NOM_MUN', 'planteles.descripcion as plantel')
            ->where('geodatabase.municipios_view.CVE_ENT', '23')
            ->get();

        return view('media_superior.administracion.sedesAlternas.index', compact('sedes'));
    }

    public function create()
    {
        $planteles   = Plantel::pluck('descripcion', 'id');
        $municipios  = $this->getMunicipios();
        $localidades = [ '000' => 'Seleccionar ...' ];

        //$localidades   = $this->getLocalidades('004');

        return view('media_superior.administracion.sedesAlternas.create', compact('planteles', 'municipios', 'localidades'));
    }

    public function store(Request $request)
    {
        $error = false;

        try {
            DB::beginTransaction();
            $domicilio = new Domicilio($request->only([
                'cve_ent',
                'cve_mun',
                'cve_loc',
                'colonia',
                'calle',
                'numero',
                'codigo_postal',
            ]));
            $domicilio->save();

            $sedeAlterna = SedeAlterna::create([
                'descripcion'  => $request->get('descripcion'),
                'sede_ceneval' => 0,
                'domicilio_id' => $domicilio->id,
                'plantel_id'   => $request->get('plantel_id'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            DB::rollback();
            $error = true;
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
            DB::rollback();
            $error = true;
        }
        if ( ! $error)
            flash('La sede alterna se guardó correctamente')->success();

        if ($request->has('addanother')) {
            return back();
        }

        return redirect(route('media.administracion.sedesAlternas.index'));
    }

    public function edit($id)
    {
        $sedeAlterna = SedeAlterna::find($id);
        $domicilio   = Domicilio::find($sedeAlterna->domicilio_id);
        $planteles   = Plantel::pluck('descripcion', 'id');
        $municipios  = $this->getMunicipios();
        $localidades = $this->getLocalidades($domicilio->cve_mun);

        return view('media_superior.administracion.sedesAlternas.edit', compact('sedeAlterna', 'domicilio', 'planteles', 'municipios', 'localidades'));
    }


    public function update(Request $request, $id)
    {

        $error = false;
        DB::beginTransaction();

        try {
            SedeAlterna::find($request->input('id'))->update($request->all());
            Domicilio::find($request->input('domicilio_id'))->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $error = true;
        } catch (\Throwable $e) {
            DB::rollback();
            $error = true;
        }

        if ( ! $error)
            flash('La sede alterna se actualizo correctamente')->success();


        return redirect(route('media.administracion.sedesAlternas.index'));
    }

    protected function getMunicipios()
    {
        return MunicipioView::where('CVE_ENT', 23)
            ->orderBy('NOM_MUN')
            ->pluck('NOM_MUN', 'CVE_MUN');
    }

    protected function getLocalidades($cve_mun)
    {
        //dd($cve_mun);
        $localidades = Localidad::where('CVE_ENT', 23)->where('CVE_MUN', $cve_mun)
            ->pluck('NOM_LOC', 'CVE_LOC');

        return $localidades;
    }


    public function localidades(Request $request)
    {
        $cve_mun = $request->get('cve_mun');
        $nom_loc = $request->get('q');
        /*$localidades = Localidad::where('CVE_ENT', 23)->where('CVE_MUN', $cve_mun)->where('NOM_LOC','LIKE','%'.$nom_loc.'%')
            ->pluck('NOM_LOC', 'CVE_LOC');*/

        $localidades = Localidad::select('CVE_LOC', 'NOM_LOC')->where('CVE_ENT', 23)->where('CVE_MUN', $cve_mun)
            ->Where('NOM_LOC', 'LIKE', '%' . $nom_loc . '%')->get();

        //dd($localidades);

        return response()->json($localidades);


        //dd($localidades);
        //return response()->json($localidades);
        //return $localidades;
    }

    public function aulas($sede_id)
    {
        $sedeAlterna = SedeAlterna::find($sede_id);

        $aulas = $sedeAlterna->aulas;

        return view('media_superior.administracion.sedesAlternas.aulas', compact('sedeAlterna', 'aulas'));
    }
}
