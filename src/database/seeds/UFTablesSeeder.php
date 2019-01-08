<?php

namespace Larangular\UnidadFomento\database\seeds;

use Illuminate\Database\Seeder;
use Larangular\UnidadFomento\Http\Controllers\UnidadFomento\UnidadFomentoController;

class UFTablesSeeder extends Seeder {

    private $UFController;

    public function __construct() {
        $this->UFController = new UnidadFomentoController();
    }

    public function run() {
        $startDate = config('unidad-fomento.migration_seed_from');
        $endDate = date('Y-m-d');
        $this->UFController->loadRange($startDate, $endDate);
    }

}
