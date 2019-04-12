<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2019-01-15
 * Time: 22:59
 */

namespace Billy\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Billy\Http\Controllers';

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
        Route::prefix('billy')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('app/Modules/Billy/Routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api/billy')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('app/Modules/Billy/Routes/api.php'));
    }
}
