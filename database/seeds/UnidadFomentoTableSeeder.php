<?php

use Illuminate\Database\Seeder;
use Larangular\UnidadFomento\Http\Controllers\UnidadFomento\UnidadFomentoController;
use Illuminate\Support\Carbon;
use Larangular\UnidadFomento\Models\UnidadFomento;
use Larangular\MigrationPackage\Migration\MigrationSeeder;

class UnidadFomentoTableSeeder extends Seeder {

    use MigrationSeeder;
    private $UFController;
    private $startDate;

    public function __construct() {
        $this->UFController = new UnidadFomentoController();
        $this->startDate = Carbon::createFromFormat('Y-m-d', config('unidad-fomento.migration_seed_from'));
    }

    public function run() {
        $csvStartSince = Carbon::createFromFormat('Y-m-d', '2016-01-01');

        if($csvStartSince->lessThan($this->startDate)) {
            $entries = $this->getData(__DIR__ . '/UF.csv');
            UnidadFomento::insert($entries);
        }

        $this->downloadRange();
    }

    private function downloadRange() {
        $endDate = date('Y-m-d');
        $this->UFController->loadRange($this->startDate, $endDate);
    }

}
