<?php

namespace Larangular\UnidadFomento;

use Larangular\Installable\Support\{InstallableServiceProvider as ServiceProvider, PublisableGroups, PublishableGroups};
use Larangular\UFScraper\UFScraperServiceProvider;
use Larangular\UnidadFomento\Commands\UnidadFomento;
use Larangular\Installable\{Contracts\HasInstallable,
    Contracts\Installable,
    Installer\Installer};

class UnidadFomentoServiceProvider extends ServiceProvider implements HasInstallable {

    protected $defer = false;

    public function boot() {

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->publishesType([
            __DIR__ . '/../config/unidad-fomento.php' => config_path('unidad-fomento.php'),
        ], PublishableGroups::Config);

        $this->loadMigrationsFrom([
            __DIR__ . '/database/migrations',
            database_path('migrations/unidad-fomento'),
        ]);

        $this->commands(UnidadFomento::class);
    }

    public function register() {
        $this->app->register(UFScraperServiceProvider::class);
        $this->mergeConfigFrom(__DIR__ . '/../config/unidad-fomento.php', 'unidad-fomento');
        $this->app->singleton('UFController', function () {
            return new Http\Controllers\UnidadFomento\UnidadFomentoController();
        });

        $this->declareMigrationGlobal();
        $this->declareMigrationUnidadFomento();

    }

    public function provides() {
        return ['UFController'];
    }

    public function installer(): Installable {
        return new Installer(__CLASS__);
    }

    private function declareMigrationGlobal(): void {
        $this->declareMigration([
            'connection'   => 'mysql',
            'migrations'   => [
                'local_path' => base_path() . '/vendor/larangular/unidad-fomento/database/migrations',
            ],
            'seeds'        => [
                'local_path' => __DIR__ . '/../database/seeds',
            ],
            'seed_classes' => [
                \UnidadFomentoTableSeeder::class,
            ],
        ]);
    }

    private function declareMigrationUnidadFomento() {
        $this->declareMigration([
            'name'      => 'unidad_fomento',
            'timestamp' => true,
        ]);
    }
}
