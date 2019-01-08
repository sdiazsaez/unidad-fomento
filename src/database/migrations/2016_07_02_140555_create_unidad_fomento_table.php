<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Larangular\MigrationPackage\Migration\Schematics;

class CreateUnidadFomentoTable extends Migration
{
    use Schematics;
    protected $name = 'UF';

    public function __construct() {
        $this->connection = config('unidad-fomento.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->create(function(Blueprint $table){
            $table->increments('id');
            $table->decimal('UF', 10, 2);
            $table->date('date');
            if(config('unidad-fomento.timestamps')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->drop();
    }
}

