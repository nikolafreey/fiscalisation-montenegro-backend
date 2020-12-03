<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robe', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->string('opis', 255);
            $table->string('detaljni_opis', 255);
            $table->int('ean', 50);
            $table->boolean('status');
            $table->timestamps();

            $table->foreignId('proizvodjac_robe_id')
                ->constrained('proizvodjaci_roba')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('jedinica_mjere_id')
                ->constrained('jedinice_mjere')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robe');
    }
}
