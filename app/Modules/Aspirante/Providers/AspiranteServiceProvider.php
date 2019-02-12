<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-02-11
 * Time: 12:31
 */

namespace Aspirante\Providers;


use Aspirante\Models\RevisionRegistro;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AspiranteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'aspirantes' => RevisionRegistro::class,
        ]);
    }

    public function register()
    {

    }
}
