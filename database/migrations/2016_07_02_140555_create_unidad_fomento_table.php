<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Larangular\MigrationPackage\Migration\Schematics;

class CreateUnidadFomentoTable extends Migration {
    use Schematics;
    protected $name;
    private   $installableConfig;


    public function __construct() {
        $this->installableConfig = InstallableConfig::config('Larangular\UnidadFomento\UnidadFomentoServiceProvider');
        $this->connection = $this->installableConfig->getConnection('unidad_fomento');
        $this->name = $this->installableConfig->getName('unidad_fomento');
    }

    public function up() {
        $this->create(function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('UF', 10, 2);
            $table->date('date');

            if ($this->installableConfig->getTimestamp('unidad_fomento')) {
                $table->timestamps();
            }
        });
    }

    public function down() {
        $this->drop();
    }
}

