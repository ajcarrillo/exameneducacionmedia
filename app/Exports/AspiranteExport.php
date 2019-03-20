<?php

namespace ExamenEducacionMedia\Exports;

use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AspiranteExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $checkedAspiranteFields;
    protected $checkedUserFields;
    protected $checkedPreferencias;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        list($this->checkedAspiranteFields, $this->checkedUserFields, $this->checkedPreferencias) = $this->coleccionar($request);
    }

    public function query()
    {
        $query = DB::table('aspirantes as a');
        $query->usersFields($this->checkedUserFields);
        $query->aspirantesFields($this->checkedAspiranteFields);

        if ($this->checkedPreferencias->count()) {
            foreach ($this->checkedPreferencias as $preferencia) {
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

                $query->selectRaw("subsoe_{$preferencia}.plantel_opcion_{$preferencia}_mun, subsoe_{$preferencia}.plantel_opcion_{$preferencia}_loc, subsoe_{$preferencia}.subsistema_opcion_{$preferencia}, subsoe_{$preferencia}.plantel_opcion_{$preferencia}, especialidad_opcion_{$preferencia}");
            }
        }

        if ($this->request->filled('domicilio')) {
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

        return $query->orderBy('u.id');
    }

    public function headings(): array
    {
        $headers = [];

        if ($this->checkedUserFields->count()) {
            array_push($headers, 'user_id');
        }

        foreach ($this->checkedUserFields as $field) {
            array_push($headers, $field);
        }

        foreach ($this->checkedAspiranteFields as $field) {
            array_push($headers, $field);
        }

        foreach ($this->checkedPreferencias as $preferencia) {
            array_push($headers, "plantel_opcion_{$preferencia}_mun");
            array_push($headers, "plantel_opcion_{$preferencia}_loc");
            array_push($headers, "subsistema_opcion_{$preferencia}");
            array_push($headers, "plantel_opcion_{$preferencia}");
            array_push($headers, "especialidad_opcion_{$preferencia}");
        }

        if ($this->request->filled('domicilio')) {
            foreach ($this->getDomicilioHeaders() as $header) {
                array_push($headers, $header);
            }
        }

        return $headers;
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

    protected function getDomicilioHeaders(): array
    {
        return [
            'domicilio_mun',
            'domicilio_loc',
            'domicilio_colonia',
            'domicilio_calle',
            'domicilio_numero',
            'domicilio_codigo_postal',
        ];
    }
}
