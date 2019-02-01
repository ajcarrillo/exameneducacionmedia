<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-27
 * Time: 17:24
 */

namespace Aspirante\Traits;


use Aspirante\Models\Pase;
use Subsistema\Models\SedeAlterna;

trait GenerarPase
{
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

            if ($lugaresOcupados == $maximoNumeroLista) {
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
