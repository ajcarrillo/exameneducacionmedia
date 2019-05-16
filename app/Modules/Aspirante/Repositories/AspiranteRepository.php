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

    public function listadoGeneralPorMunSubLocPlantel()
    {
        return "SELECT planteles.nombre_municipio,
subsistemas.referencia AS subsistema,
planteles.nombre_localidad,
planteles.descripcion plantel,
IF(IsNull(sum(proceso_completo)), 0, sum(proceso_completo)) AS proceso_completo,
IF(IsNull(sum(aspirantes_sin_pase.sin_pase)), 0, sum(aspirantes_sin_pase.sin_pase)) AS sin_pase,
IF(IsNull(sum(sin_registro)), 0, sum(sin_registro)) AS sin_registro,
IF(IsNull(sum(aspirantes_con_registro_sin_pago.con_pago)), 0, sum(aspirantes_con_registro_sin_pago.con_pago)) AS con_registro_sin_pago,
IF(IsNull(sum(demanda)), 0, sum(demanda)) AS demanda,
IF(IsNull(sum(oferta)), 0, sum(oferta)) AS oferta,
IF(IsNull(sum(aforo)), 0, sum(aforo)) AS aforo
FROM planteles
INNER JOIN subsistemas ON planteles.subsistema_id = subsistemas.id
INNER JOIN geodatabase.mun_loc_qroo_camp AS geo
ON planteles.cve_ent = geo.CVE_ENT AND planteles.cve_mun = geo.CVE_MUN AND planteles.cve_loc = geo.CVE_LOC

LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS proceso_completo
FROM pases_examen
INNER JOIN aspirantes ON pases_examen.aspirante_id = aspirantes.id
INNER JOIN seleccion_ofertas_educativas ON aspirantes.id = seleccion_ofertas_educativas.aspirante_id AND
                              seleccion_ofertas_educativas.preferencia = 1
INNER JOIN ofertas_educativas ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
GROUP BY planteles.id) AS aspirantes_con_pase ON planteles.id = aspirantes_con_pase.id

LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS con_pago
FROM revision_registros
INNER JOIN aspirantes ON revision_registros.aspirante_id = aspirantes.id AND efectuado = 1
INNER JOIN seleccion_ofertas_educativas ON aspirantes.id = seleccion_ofertas_educativas.aspirante_id AND
                              seleccion_ofertas_educativas.preferencia = 1
INNER JOIN ofertas_educativas ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
GROUP BY planteles.id) AS aspirantes_con_pago ON planteles.id = aspirantes_con_pago.id

LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS sin_registro
FROM aspirantes
LEFT JOIN revision_registros ON aspirantes.id = revision_registros.aspirante_id
INNER JOIN seleccion_ofertas_educativas ON aspirantes.id = seleccion_ofertas_educativas.aspirante_id AND
                              seleccion_ofertas_educativas.preferencia = 1
INNER JOIN ofertas_educativas ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
WHERE revision_registros.id IS NULL
GROUP BY planteles.id) AS aspirantes_sin_registro ON planteles.id = aspirantes_sin_registro.id

LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS con_pago
FROM revision_registros
INNER JOIN aspirantes ON revision_registros.aspirante_id = aspirantes.id AND efectuado = 0
INNER JOIN seleccion_ofertas_educativas ON aspirantes.id = seleccion_ofertas_educativas.aspirante_id AND
                              seleccion_ofertas_educativas.preferencia = 1
INNER JOIN ofertas_educativas ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
GROUP BY planteles.id) AS aspirantes_con_registro_sin_pago ON planteles.id = aspirantes_con_registro_sin_pago.id

LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS demanda
FROM planteles
INNER JOIN ofertas_educativas ON planteles.id = ofertas_educativas.plantel_id
INNER JOIN seleccion_ofertas_educativas
ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id AND
seleccion_ofertas_educativas.preferencia = 1
GROUP BY planteles.id) AS demandas ON planteles.id = demandas.id

LEFT JOIN (SELECT planteles.id,
sum((oferta_educativa_grupos.alumnos * oferta_educativa_grupos.grupos)) AS oferta
FROM planteles
INNER JOIN ofertas_educativas ON planteles.id = ofertas_educativas.plantel_id
INNER JOIN oferta_educativa_grupos ON ofertas_educativas.id = oferta_educativa_grupos.oferta_educativa_id
WHERE planteles.active = 1 AND ofertas_educativas.active = 1
GROUP BY planteles.id) AS ofertas ON planteles.id = ofertas.id

LEFT JOIN (SELECT planteles.id,
sum(aulas.capacidad) AS aforo
FROM aulas
INNER JOIN planteles ON aulas.edificio_id = planteles.id
WHERE aulas.edificio_type = \"plantel\"
GROUP BY planteles.id) AS aforos ON planteles.id = aforos.id
LEFT JOIN (SELECT planteles.id,
count(planteles.id) AS sin_pase
FROM aspirantes
LEFT JOIN pases_examen ON aspirantes.id = pases_examen.aspirante_id
INNER JOIN seleccion_ofertas_educativas ON aspirantes.id = seleccion_ofertas_educativas.aspirante_id AND
                              seleccion_ofertas_educativas.preferencia = 1
INNER JOIN ofertas_educativas ON seleccion_ofertas_educativas.oferta_educativa_id = ofertas_educativas.id
INNER JOIN planteles ON ofertas_educativas.plantel_id = planteles.id
WHERE pases_examen.id IS NULL
GROUP BY planteles.id) AS aspirantes_sin_pase ON planteles.id = aspirantes_sin_pase.id
WHERE planteles.active = 1
GROUP BY subsistemas.referencia, nombre_municipio, nombre_localidad, planteles.descripcion
ORDER BY nombre_municipio, subsistemas.referencia, nombre_localidad, planteles.descripcion";
    }
}
