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
        $query->aspirantesFields($checkedAspiranteFields);

        if ($checkedUserFields->count()) {
            $query->join('users as u', 'a.user_id', '=', 'u.id');
            $query->addSelect('u.id');
            foreach ($checkedUserFields as $field) {
                $query->addSelect("u.{$field}");
            }
        }

        if ($checkedPreferencias->count()) {

            foreach ($checkedPreferencias as $preferencia) {
                $subquery = DB::table("seleccion_ofertas_educativas as soe_{$preferencia}")
                    ->selectRaw("soe_{$preferencia}.*")
                    ->where("soe_{$preferencia}.preferencia", $preferencia);

                $query->leftJoin(DB::raw("({$subquery->toSql()}) as soe_{$preferencia}"), function ($join) use ($preferencia) {
                    $join->on('a.id', '=', "soe_{$preferencia}.aspirante_id");
                });

                $query->selectRaw("soe_{$preferencia}.*");
            }
        }

        $q = $query->where('a.id', 3)->toSql();

        return view('administracion.reporte_dinamico.reporte_dinamico', compact(
            'aspiranteFields', 'checkedAspiranteFields',
            'userFields', 'checkedUserFields',
            'preferencias', 'checkedPreferencias', 'q'
        ));
    }

    protected function getAspiranteFields(): array
    {
        $aspiranteFields = array(
            'telefono',
            'sexo',
            'folio',
            'pais_nacimiento_id',
            'entidad_nacimiento_id',
            'fecha_nacimiento',
            'curp',
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
