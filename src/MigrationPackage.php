<?php

namespace Larangular\UnidadFomento;

use Larangular\MigrationPackage\Contracts\CanMigrate;

class MigrationPackage implements CanMigrate {

    public function databaseConnection() {
        return config('unidad-fomento.connection');
    }

    public function migrationsPath() {
        return __DIR__ . '/database/migrations/';
    }

    public function seeders() {
        return [
            \Larangular\UnidadFomento\database\seeds\UFTablesSeeder::class
        ];
    }


}
