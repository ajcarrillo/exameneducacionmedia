<?php
/**
 * Created by PhpStorm.
 * User: wsanchez
 * Date: 29/01/2019
 * Time: 11:26 AM
 */

namespace MediaSuperior\Http\Controllers\Administracion;

use ExamenEducacionMedia\Http\Controllers\Controller;

use ExamenEducacionMedia\Models\Geodatabase\MunicipioView;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MediaSuperior\Models\Aula;
use MediaSuperior\Models\Domicilio;
use MediaSuperior\Models\Plantel;
use MediaSuperior\Models\Localidad;
use MediaSuperior\Models\SedeAlterna;

class SedeAlternaController extends Controller
{
    public function index()
    {
        //$sedes = SedeAlterna::get();

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
        $planteles = Plantel::pluck('descripcion', 'id');
        $municipios = $this->getMunicipios();
        $localidades = ['000' => 'Seleccionar ...'];
        //$localidades   = $this->getLocalidades('004');

        return view('media_superior.administracion.sedesAlternas.create', compact('planteles', 'municipios', 'localidades'));
    }

    public function store(Request $request)
    {

        $domicilio = new Domicilio($request->input());
        $domicilio->save();

        $sedeAlterna = SedeAlterna::create([
            'descripcion' => $request->get('descripcion'),
            'sede_ceneval' => 0,
            'domicilio_id' => $domicilio->id,
            'plantel_id' => $request->get('plantel_id'),
        ]);

        flash('La sede alterna se guardó correctamente')->success();
        if ($request->has('addanother')) {
            return back();
        }

        return redirect(route('media.administracion.sedesAlternas.index'));
    }

    public function edit($id)
    {
        $sedeAlterna = SedeAlterna::find($id);
        $domicilio = Domicilio::find($sedeAlterna->domicilio_id);
        $planteles = Plantel::pluck('descripcion', 'id');
        $municipios = $this->getMunicipios();
        $localidades   = $this->getLocalidades($domicilio->cve_mun);

        return view('media_superior.administracion.sedesAlternas.edit', compact('sedeAlterna', 'domicilio','planteles', 'municipios', 'localidades'));
    }


    public function update(Request $request, $id)
    {
        SedeAlterna::find($request->input('id'))->update($request->all());
        Domicilio::find($request->input('domicilio_id'))->update($request->all());

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
        $localidades = Localidad::where('CVE_ENT', 23)->where('CVE_MUN', $cve_mun)
            ->pluck('NOM_LOC', 'CVE_LOC');

        //dd($localidades);
        //return response()->json($localidades);
        return $localidades;
    }

    public function aulas($sede_id)
    {

        $aulas = Aula::where('edificio_id',$sede_id)->get();
        $sedeAlterna = SedeAlterna::find($sede_id);
        return view('media_superior.administracion.sedesAlternas.aulas', compact('sedeAlterna','aulas'));

    }
}