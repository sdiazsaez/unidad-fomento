<?php

namespace Larangular\UnidadFomento\Commands;

use Illuminate\Console\Command;
use Larangular\UnidadFomento\Http\Controllers\UnidadFomento\UnidadFomentoController;

class UnidadFomento extends Command {

    protected $signature = 'uf:load';
    protected $description = 'Scrape and load missing UF values from last record date.';
    //private $UFController;

    public function __construct() {
        parent::__construct();
        //$this->UFController = new UnidadFomentoController();
    }

    public function handle() {
        UFController::loadFromLastRecord();
        //$this->UFController->loadFromLastRecord();
    }
}
