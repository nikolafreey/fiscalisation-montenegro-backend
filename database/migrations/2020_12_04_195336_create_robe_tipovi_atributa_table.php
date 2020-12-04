<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobeTipoviAtributaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robe_tipovi_atributa', function (Blueprint $table) {
            $table->id();

            $table->foreignId('roba_id')
                ->constrained('robe')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('tipovi_atributa_roba_id')
                ->constrained('tipovi_atributa_roba')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robe_tipovi_atributa');
    }
}
