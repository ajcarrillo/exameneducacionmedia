<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-06
 * Time: 19:33
 */

namespace MediaSuperior\Providers;


use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Subsistema\Models\SedeAlterna;

class MediaSuperiorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'sede_alterna' => SedeAlterna::class,
        ]);
    }

    public function register()
    {

    }
}
