<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:30
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
use ExamenEducacionMedia\Classes\SolicitudPago;
use ExamenEducacionMedia\Models\Entidad;
use ExamenEducacionMedia\Models\Geodatabase\Pais;
use ExamenEducacionMedia\User;
use Illuminate\Database\Eloquent\Model;
use Subsistema\Models\SedeAlterna;

class Aspirante extends Model
{
    use Compoships;

    protected $table    = 'aspirantes';
    protected $fillable = [
        'alumno_id', 'user_id', 'telefono', 'sexo', 'folio',
        'pais_nacimiento_id', 'entidad_nacimiento_id', 'domicilio_id',
        'informacion_procedencia_id', 'curp', 'fecha_nacimiento',
        'curp_historica', 'curp_valida', 'matricula',
    ];
    protected $casts    = [
        'curp_historica'   => 'boolean',
        'curp_valida'      => 'boolean',
        'fecha_nacimiento' => 'datetime:Y-m-d',
    ];
    protected $appends  = [
        'is_aspirante_externo',
    ];

    public function controlEscolar()
    {
        return $this->belongsTo(Estudiante::class, 'alumno_id');
    }

    public function respuestasCeneval()
    {
        return $this->hasMany(AspiranteRespuesta::class, 'aspirante_id');
    }

    public function revision()
    {
        return $this->hasOne(RevisionRegistro::class, 'aspirante_id');
    }

    public function paseExamen()
    {
        return $this->hasOne(Pase::class, 'aspirante_id');
    }

    public function opcionesEducativas()
    {
        return $this->hasMany(Seleccion::class, 'aspirante_id');
    }

    public function paisNacimiento()
    {
        return $this->belongsTo(Pais::class, 'pais_nacimiento_id');
    }

    public function entidadNacimiento()
    {
        return $this->belongsTo(Entidad::class, 'entidad_nacimiento_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function informacionProcedencia()
    {
        return $this->belongsTo(InformacionProcedencia::class, 'informacion_procedencia_id');
    }

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'domicilio_id');
    }

    public function getIsAspiranteExternoAttribute()
    {
        return $this->alumno_id ? false : true;
    }

    public function hasInformacionCompleta()
    {
        if ( ! $this->hasDomicilio() ||
            ! $this->hasInformacionProcedencia() ||
            ! $this->hasSeleccion() ||
            ! $this->hasRespuestasCeneval()) {
            return false;
        }

        return true;
    }

    public function asignarPase()
    {
        $primerOpcion = $this->opcionesEducativas()->where('preferencia', 1)->firstOrFail();
        $plantel      = $primerOpcion->ofertaEducativa->plantel;
        $aulas        = $plantel->aulas;
        $asignado     = $this->distribuirPase($aulas);

        if ( ! $asignado) {
            $sedesAlternas = SedeAlterna::where('plantel_id', $plantel->id)->get();
            foreach ($sedesAlternas as $sede) {
                $aulas = $sede->aulas;
                if ($this->distribuirPase($aulas)) {
                    $asignado = true;
                    break;
                }
            }
        }

        return $asignado;
    }

    public function crearRevision($solicitudPagoId)
    {
        $revisionRegistro = new RevisionRegistro([
            'efectuado'         => false,
            'solicitud_pago_id' => $solicitudPagoId,
        ]);

        $this->revision()->save($revisionRegistro);
    }

    protected function distribuirPase($aulas)
    {
        $asignado = false;

        foreach ($aulas as $aula) {
            $pase            = Pase::where('aula_id', $aula->id);
            $lugaresOcupados = $pase->count();

            if ($lugaresOcupados == $aula->capacidad) {
                break;
            }

            if ( ! $pase->exists()) {
                $maximoNumeroLista = 0;
            } else {
                $maximoNumeroLista = $pase->max('numero_lista');
            }

            $nuevoPase               = new Pase();
            $nuevoPase->numero_lista = $maximoNumeroLista + 1;
            $nuevoPase->automatico   = false;
            $nuevoPase->aula_id      = $aula->id;

            try {
                $nuevoPase->aspirante()->associate($this)->save();
                $asignado = true;
                break;
            } catch (\Exception $e) {

            }
        }

        return $asignado;
    }

    protected function hasDomicilio()
    {
        return $this->domicilio()->exists();
    }

    protected function hasInformacionProcedencia()
    {
        return $this->informacionProcedencia()->exists();
    }

    protected function hasSeleccion()
    {
        return $this->opcionesEducativas()->exists();
    }

    protected function hasRespuestasCeneval()
    {
        return $this->respuestasCeneval()->exists();
    }

    public static function listaSexos()
    {
        $sexos = [
            ''  => 'Seleccione...',
            'H' => 'Hombre',
            'M' => 'Mujer',
        ];

        return $sexos;
    }

    public static function dataForAspirantes1erOp()
    {
        return \DB::table('aspirantes')->select('aspirantes.folio',
            \DB::raw('concat(users.primer_apellido," ",users.segundo_apellido," ",users.nombre) as nombre_completo'),
            \DB::raw('concat(planteles.clave," - ",planteles.descripcion) as plantel'),
            'especialidades.referencia as especialidad',
            'subsistemas.referencia as subsistema',
            \DB::raw('concat(informacion_procedencias.clave_centro_trabajo," - ",informacion_procedencias.nombre_centro_trabajo) as nombre_centro_trabajo'),
            \DB::raw('SUBSTRING(informacion_procedencias.clave_centro_trabajo,3,3) as modalidad'),
            \DB::raw('IF(revision_registros.efectuado="1","SI","NO") as revision_efectuada'),
            \DB::raw('IF(pases_examen.id,"SI","NO") as pase_examen'))
            ->join('users', 'users.id', '=', 'aspirantes.user_id')
            ->join('informacion_procedencias', 'informacion_procedencias.id', '=', 'aspirantes.informacion_procedencia_id')
            ->leftjoin('pases_examen', 'pases_examen.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('seleccion_ofertas_educativas', 'seleccion_ofertas_educativas.aspirante_id', '=', 'aspirantes.id')
            ->leftjoin('ofertas_educativas', 'ofertas_educativas.id', '=', 'seleccion_ofertas_educativas.oferta_educativa_id')
            ->leftjoin('planteles', 'planteles.id', '=', 'ofertas_educativas.plantel_id')
            ->leftjoin('especialidades', 'especialidades.id', '=', 'ofertas_educativas.especialidad_id')
            ->leftjoin('subsistemas', 'subsistemas.id', '=', 'planteles.subsistema_id')
            ->leftjoin('revision_registros', 'revision_registros.aspirante_id', '=', 'aspirantes.id')
            ->groupBy('aspirantes.id')
            ->orderBy('informacion_procedencias.clave_centro_trabajo')
            ->orderBy('users.primer_apellido')
            ->get();
    }

    public function updateFichaJson($solicitudPagoId)
    {
        try {
            $fichaJson = SolicitudPago::getFichaPago($solicitudPagoId);
            $this->revision()->update([ 'ficha_json' => $fichaJson ]);

            return $fichaJson;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception('Ocurrió un error al intentar obtener la información de la ficha de pago');
        }
    }

    public function hasPaseAlExamen()
    {
        return $this->paseExamen()->exists();
    }
}
