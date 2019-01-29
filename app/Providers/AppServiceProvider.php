<?php

namespace ExamenEducacionMedia\Providers;

use ExamenEducacionMedia\Jarvis\JarvisProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::withDoubleEncoding();
        Blade::component('components.table', 'table');
        Blade::component('components.form_errors', 'errors');

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'siie',
            function ($app) use ($socialite) {
                $config = $app['config']['services.siie'];
                return $socialite->buildProvider(JarvisProvider::class, $config);
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
