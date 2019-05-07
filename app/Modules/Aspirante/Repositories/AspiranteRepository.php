<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-03-27
 * Time: 00:01
 */

namespace Aspirante\Repositories;


use Aspirante\Models\Aspirante;
use Aspirante\Models\Filters\AspiranteFilters;
use DB;
use ExamenEducacionMedia\Classes\BaseRepository;

class AspiranteRepository extends BaseRepository
{

    public function getModel()
    {
        return new Aspirante();
    }

    public function listarAspirantes(array $params = [])
    {
        $query = $this->newQuery()
            ->join('users', 'aspirantes.user_id', '=', 'users.id')
            ->filterBy(new AspiranteFilters, $params)
            ->select(
                'aspirantes.id', DB::raw('users.id as user_id'), 'aspirantes.folio', 'users.uuid',
                'aspirantes.curp', 'aspirantes.matricula', 'users.email',
                DB::raw("UPPER(concat_ws(' ', nombre, primer_apellido, segundo_apellido)) as nombre_completo")
            );

        return $query;
    }

    public function listarAspirantesPorPlantel(array $params = [])
    {
        $query = $this->listarAspirantes($params);

        $query->join('seleccion_ofertas_educativas', function ($join) {
            $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                ->where('seleccion_ofertas_educativas.preferencia', '=', 1);
        })->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
            ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id');

        return $query;
    }

    public function aspirantesConSeleccion(array $params = [])
    {
        $query = $this->listarAspirantes($params);

        $query->join('seleccion_ofertas_educativas', function ($join) {
            $join->on('aspirantes.id', '=', 'seleccion_ofertas_educativas.aspirante_id')
                ->where('seleccion_ofertas_educativas.preferencia', '=', 1);
        })
            ->join('ofertas_educativas', 'seleccion_ofertas_educativas.oferta_educativa_id', '=', 'ofertas_educativas.id')
            ->join('planteles', 'ofertas_educativas.plantel_id', '=', 'planteles.id')
            ->join('subsistemas', 'planteles.subsistema_id', '=', 'subsistemas.id');

        return $query;
    }

    public function aspirantesConProcesoCompleto(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('pases_examen', 'aspirantes.id', '=', 'pases_examen.aspirante_id');

        return $query;
    }

    public function aspirantesConPagoPendiente(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->where('efectuado', 0);

        return $query;
    }

    public function aspirantesSinEnvioRegistro(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->leftJoin('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->whereNull('revision_registros.id');

        return $query;
    }

    public function aspirantesConPago(array $params = [])
    {
        $query = $this->aspirantesConSeleccion($params);

        $query->join('revision_registros', 'aspirantes.id', '=', 'revision_registros.aspirante_id')
            ->where('efectuado', 1);

        return $query;
    }

    public function listadoAspirantesPorPlantel()
    {
        return "SELECT aspirantes.folio,
       concat_ws(' ', users.nombre, users.primer_apellido, users.segundo_apellido) AS nombre_completo,
       aspirantes.sexo,
       aspirantes.fecha_nacimiento,
       aspirantes.curp,
       if(aspirantes.curp_valida = 0, 'NO', 'SI') curp_valida,
       if((aspirantes.curp_historica = 0 OR aspirantes.curp_historica IS NULL), 'NO', 'SI') curp_historica,
       aspirantes.matricula,
       users.email,
       upper(concat_ws(' ', domicilios.calle, concat(', NÚMERO: ', domicilios.numero, ', '), concat_ws(' / ', geo.NOM_LOC, geo.NOM_MUN))) AS domicilio,
       aspirantes.telefono,
       IF((SELECT aspirante_id
           FROM revision_registros
           WHERE efectuado = 1 AND revision_registros.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS tiene_pago,
       if((SELECT aspirante_id
           FROM revision_registros
           WHERE revision_registros.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS envio_registro,
       if((SELECT aspirante_id
           FROM pases_examen
           WHERE pases_examen.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS con_pase,
       ip.clave_centro_trabajo AS procedencia_clave_centro_trabajo,
       ip.nombre_centro_trabajo AS procedencia_nombre_centro_trabajo,
       ip.fecha_egreso,
       concat_ws(' - ', planteles.descripcion, especialidades.referencia) AS primera_opcion,
       planteles.nombre_municipio
FROM aspirantes
    INNER JOIN users ON aspirantes.user_id = users.id
    INNER JOIN seleccion_ofertas_educativas soe ON aspirantes.id = soe.aspirante_id AND preferencia = 1
    INNER JOIN ofertas_educativas ON soe.oferta_educativa_id = ofertas_educativas.id
    INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
    INNER JOIN especialidades ON ofertas_educativas.especialidad_id = especialidades.id
    INNER JOIN subsistemas ON planteles.subsistema_id = subsistemas.id
    LEFT JOIN domicilios ON aspirantes.domicilio_id = domicilios.id
    LEFT JOIN geodatabase.mun_loc_qroo_camp AS geo ON geo.CVE_ENT = domicilios.cve_ent AND geo.CVE_MUN = domicilios.cve_mun AND geo.CVE_LOC = domicilios.cve_loc
    LEFT JOIN informacion_procedencias ip ON aspirantes.informacion_procedencia_id = ip.id
WHERE planteles.id = ?";
    }

    public function listadoAspirantesPorSubsistema()
    {
        return "SELECT aspirantes.folio,
       concat_ws(' ', users.nombre, users.primer_apellido, users.segundo_apellido) AS nombre_completo,
       aspirantes.sexo,
       aspirantes.fecha_nacimiento,
       aspirantes.curp,
       if(aspirantes.curp_valida = 0, 'NO', 'SI') curp_valida,
       if((aspirantes.curp_historica = 0 OR aspirantes.curp_historica IS NULL), 'NO', 'SI') curp_historica,
       aspirantes.matricula,
       users.email,
       upper(concat_ws(' ', domicilios.calle, concat(', NÚMERO: ', domicilios.numero, ', '), concat_ws(' / ', geo.NOM_LOC, geo.NOM_MUN))) AS domicilio,
       aspirantes.telefono,
       IF((SELECT aspirante_id
           FROM revision_registros
           WHERE efectuado = 1 AND revision_registros.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS tiene_pago,
       if((SELECT aspirante_id
           FROM revision_registros
           WHERE revision_registros.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS envio_registro,
       if((SELECT aspirante_id
           FROM pases_examen
           WHERE pases_examen.aspirante_id = aspirantes.id) IS NOT NULL, 'SI', 'NO') AS con_pase,
       ip.clave_centro_trabajo AS procedencia_clave_centro_trabajo,
       ip.nombre_centro_trabajo AS procedencia_nombre_centro_trabajo,
       ip.fecha_egreso,
       concat_ws(' - ', planteles.descripcion, especialidades.referencia) AS primera_opcion,
       planteles.nombre_municipio
FROM aspirantes
    INNER JOIN users ON aspirantes.user_id = users.id
    INNER JOIN seleccion_ofertas_educativas soe ON aspirantes.id = soe.aspirante_id AND preferencia = 1
    INNER JOIN ofertas_educativas ON soe.oferta_educativa_id = ofertas_educativas.id
    INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
    INNER JOIN especialidades ON ofertas_educativas.especialidad_id = especialidades.id
    INNER JOIN subsistemas ON planteles.subsistema_id = subsistemas.id
    LEFT JOIN domicilios ON aspirantes.domicilio_id = domicilios.id
    LEFT JOIN geodatabase.mun_loc_qroo_camp AS geo ON geo.CVE_ENT = domicilios.cve_ent AND geo.CVE_MUN = domicilios.cve_mun AND geo.CVE_LOC = domicilios.cve_loc
    LEFT JOIN informacion_procedencias ip ON aspirantes.informacion_procedencia_id = ip.id
WHERE subsistemas.id = ?";
    }
}
