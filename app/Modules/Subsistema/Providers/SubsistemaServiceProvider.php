<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 11:23
 */

namespace Subsistema\Providers;


use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Subsistema\Models\OfertaEducativa;
use Subsistema\Models\Plantel;
use Subsistema\Models\SedeAlterna;

class SubsistemaServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Relation::morphMap([
            'plantel'      => Plantel::class,
            'sede_alterna' => SedeAlterna::class,
            'oferta_educativa' => OfertaEducativa::class,
        ]);
    }

    public function register()
    {
        
    }
}
