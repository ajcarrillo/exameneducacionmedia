<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:59
 */

namespace Aspirante\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Aspirante\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function register()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::prefix('aspirantes')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('app/Modules/Aspirante/Routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api/aspirantes')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('app/Modules/Aspirante/Routes/api.php'));
    }
}
