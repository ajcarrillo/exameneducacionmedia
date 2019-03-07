<?php

namespace ExamenEducacionMedia\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class EtapaProceso extends Model
{
    protected $table   = 'etapas_proceso';
    protected $guarded = [];
    protected $appends = [
        'fecha_apertura', 'fecha_cierre'
    ];

    public static function isAforo(): bool
    {
        $aforo = EtapaProceso::getStage('AFORO');

        return EtapaProceso::isStage($aforo);
    }

    public static function isOferta(): bool
    {
        $oferta = EtapaProceso::getStage('OFERTA');

        return EtapaProceso::isStage($oferta);
    }

    public static function isRegistro(): bool
    {
        $registro = EtapaProceso::getStage('REGISTRO');

        return EtapaProceso::isStage($registro);
    }

    public static function getEtapa($nombre)
    {
        return EtapaProceso::getStage($nombre);
    }

    protected static function getStage($etapa): EtapaProceso
    {
        return EtapaProceso::where('nombre', $etapa)->first();
    }

    protected static function isStage(EtapaProceso $proceso): bool
    {
        $now = Carbon::now()->format('Y-m-d');
        if (($now >= $proceso->apertura) && ($now <= $proceso->cierre)) {
            return true;
        }

        return false;
    }

    public function getFechaAperturaAttribute()
    {
        Date::setLocale('es');
        $date = new Date($this->apertura);

        return strtoupper($date->format('j \\d\\e F \\d\\e Y'));
    }

    public function getFechaCierreAttribute()
    {
        Date::setLocale('es');
        $date = new Date($this->cierre);

        return strtoupper($date->format('j \\d\\e F \\d\\e Y'));
    }
}
