<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:23
 */

namespace Subsistema\Providers;


use ExamenEducacionMedia\Modules\Subsistema\Models\RevisionAforo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
use Subsistema\Models\RevisionOferta;
use Subsistema\Models\SedeAlterna;

class SubsistemaServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Relation::morphMap([
            'plantel'      => Plantel::class,
            'sede_alterna' => SedeAlterna::class,
            'oferta_educativa' => OfertaEducativa::class,
            'ofertas' => RevisionOferta::class,
            'aforos' => RevisionAforo::class,
        ]);
    }

    public function register()
    {

    }
}
