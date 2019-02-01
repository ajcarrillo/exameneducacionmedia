<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 27/10/18
 * Time: 13:47
 */

namespace ExamenEducacionMedia\Providers;


use Carbon\Laravel\ServiceProvider;
use ExamenEducacionMedia\Http\ViewComposers\LoginAsUserComposer;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', LoginAsUserComposer::class);
    }

    public function register()
    {

    }
}
