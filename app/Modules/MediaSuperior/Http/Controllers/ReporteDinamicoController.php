<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-18
 * Time: 22:21
 */

namespace MediaSuperior\Http\Controllers;


use DB;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteDinamicoController extends Controller
{
    public function index(Request $request)
    {
        #\Log::info($request);
        $aspiranteFields = $this->getAspiranteFields();
        $userFields      = $this->getUserFields();
        $preferencias    = $this->getPreferenciaFields();

        list($checkedAspiranteFields, $checkedUserFields, $checkedPreferencias) = $this->coleccionar($request);

        $query = DB::table('aspirantes as a');
        $query->usersFields($checkedUserFields);
        $query->aspirantesFields($checkedAspiranteFields);

        if ($checkedPreferencias->count()) {
            foreach ($checkedPreferencias as $preferencia) {
                $subquery = DB::table("seleccion_ofertas_educativas as soe_{$preferencia}")
                    ->join('ofertas_educativas as ofer', "soe_{$preferencia}.oferta_educativa_id", '=', 'ofer.id')
                    ->join('planteles as plan', 'ofer.plantel_id', '=', 'plan.id')
                    ->join('subsistemas as sub', 'plan.subsistema_id', '=', 'sub.id')
                    ->join('geodatabase.mun_loc_qroo_camp as geo', function ($join) {
                        $join->on('geo.CVE_ENT', '=', 'plan.cve_ent')
                            ->on('geo.CVE_MUN', '=', 'plan.cve_mun')
                            ->on('geo.CVE_LOC', '=', 'plan.cve_loc');
                    })
                    ->join('especialidades as espe', 'ofer.especialidad_id', '=', 'espe.id')
                    ->selectRaw(
                        "soe_{$preferencia}.aspirante_id, geo.NOM_MUN as plantel_opcion_{$preferencia}_mun, geo.NOM_LOC as plantel_opcion_{$preferencia}_loc, sub.referencia as subsistema_opcion_{$preferencia}, plan.descripcion as plantel_opcion_{$preferencia}, espe.referencia as especialidad_opcion_{$preferencia}"
                    )
                    ->where("soe_{$preferencia}.preferencia", $preferencia);

                $query->leftJoin(DB::raw("({$subquery->toSql()}) as subsoe_{$preferencia}"), function ($join) use ($preferencia) {
                    $join->on('a.id', '=', "subsoe_{$preferencia}.aspirante_id");
                })->mergeBindings($subquery);

                $query->selectRaw("subsoe_{$preferencia}.*");
            }
        }

        if ($request->filled('domicilio')) {
            $query->leftJoin('domicilios as dom', 'a.domicilio_id', '=', 'dom.id')
                ->join('geodatabase.mun_loc_qroo_camp as geo', function ($join) {
                    $join->on('geo.CVE_ENT', '=', 'dom.cve_ent')
                        ->on('geo.CVE_MUN', '=', 'dom.cve_mun')
                        ->on('geo.CVE_LOC', '=', 'dom.cve_loc');
                })
                ->addSelect(
                    DB::raw('geo.NOM_MUN as domicilio_mun, geo.NOM_LOC as domicilio_loc, dom.colonia as domicilio_colonia, dom.calle as domicilio_calle, dom.numero as domicilio_numero, dom.codigo_postal as domicilio_codigo_postal')
                );
        }

        //TODRES: validar que exista asignación y mostrarla

        //$q = $query->get();
        $q = $query->toSql();

        return view('administracion.reporte_dinamico.reporte_dinamico', compact(
            'aspiranteFields', 'checkedAspiranteFields',
            'userFields', 'checkedUserFields',
            'preferencias', 'checkedPreferencias', 'q'
        ));
    }

    protected function getAspiranteFields(): array
    {
        $aspiranteFields = array(
            'folio',
            'sexo',
            'fecha_nacimiento',
            'curp',
            'pais_nacimiento_id',
            'entidad_nacimiento_id',
            'telefono',
            'curp_historica',
            'curp_valida',
        );

        return $aspiranteFields;
    }

    protected function getUserFields(): array
    {
        $userFields = array(
            'nombre',
            'primer_apellido',
            'segundo_apellido',
            'email',
            'username',
        );

        return $userFields;
    }

    protected function coleccionar(Request $request): array
    {
        $checkedAspiranteFields = collect($request->get('aspfields'));
        $checkedUserFields      = collect($request->get('usrfields'));
        $checkedPreferencias    = collect($request->get('preferencias'));

        return array( $checkedAspiranteFields, $checkedUserFields, $checkedPreferencias );
    }

    protected function getPreferenciaFields(): array
    {
        $preferencias = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );

        return $preferencias;
    }
}
