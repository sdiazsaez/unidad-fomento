<?php

namespace Larangular\UnidadFomento;

use \Illuminate\Support\ServiceProvider;
use Larangular\UFScraper\UFScraperServiceProvider;
use Larangular\UnidadFomento\Commands\UnidadFomento;

class UnidadFomentoServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/Http/Routes/UnidadFomentoRoutes.php');
        $this->publishes([
                             __DIR__ . '/../config/unidad-fomento.php' => config_path('unidad-fomento.php'),
                         ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->commands(UnidadFomento::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->register(UFScraperServiceProvider::class);
        $this->app->bind('UFController', function(){
            return new Http\Controllers\UnidadFomento\UnidadFomentoController();
        });
    }
}
