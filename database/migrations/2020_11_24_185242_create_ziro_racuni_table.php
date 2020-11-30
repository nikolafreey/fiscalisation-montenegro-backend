<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZiroRacuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ziro_racuni', function (Blueprint $table) {
            $table->id();
            $table->string('broj_racuna', 50);

            $table->foreignId('preduzece_id')
                ->nullable()
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('fizicko_lice_id')
                ->nullable()
                ->constrained('fizicka_lica')
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
        Schema::dropIfExists('ziro_racuns');
    }
}
