<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-18
 * Time: 11:30
 */

namespace Aspirante\Models;


use Awobaz\Compoships\Compoships;
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
        'curp_historica', 'curp_valida',
    ];
    protected $casts    = [
        'curp_historica'   => 'boolean',
        'curp_valida'      => 'boolean',
        'fecha_nacimiento' => 'datetime:Y-m-d',
    ];
    protected $appends  = [
        'is_aspirante_externo',
    ];

    public function revisiones()
    {
        return $this->hasMany(RevisionRegistro::class, 'aspirante_id');
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

    protected function distribuirPase($aulas)
    {
        $asignado = false;

        foreach ($aulas as $aula) {
            $pase            = Pase::where('aula_id', $aula->id);
            $lugaresOcupados = $pase->count();

            if ( ! $pase->exists()) {
                $maximoNumeroLista = 0;
            } else {
                $maximoNumeroLista = $pase->max('numero_lista');
            }

            if ($lugaresOcupados == $aula->capacidad) {
                break;
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
}
