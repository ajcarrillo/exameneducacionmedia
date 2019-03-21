<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-18
 * Time: 22:21
 */

namespace MediaSuperior\Http\Controllers;


use DB;
use ExamenEducacionMedia\Exports\AspiranteExport;
use ExamenEducacionMedia\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteDinamicoController extends Controller
{
    public function index(Request $request)
    {
        $aspiranteFields = $this->getAspiranteFields();
        $userFields      = $this->getUserFields();
        $preferencias    = $this->getPreferenciaFields();

        list($checkedAspiranteFields, $checkedUserFields, $checkedPreferencias) = $this->coleccionar($request);

        return view('administracion.reporte_dinamico.reporte_dinamico', compact(
            'aspiranteFields', 'checkedAspiranteFields',
            'userFields', 'checkedUserFields',
            'preferencias', 'checkedPreferencias'
        ));
    }

    public function download(Request $request)
    {
        return (new AspiranteExport($request))->download('aspirantes.xlsx');
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
