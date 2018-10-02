<?php

namespace ExamenEducacionMedia\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EtapaProceso extends Model
{
    protected $table   = 'etapas_proceso';
    protected $guarded = [];

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
}
