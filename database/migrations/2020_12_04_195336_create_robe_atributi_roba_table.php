<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobeAtributiRobaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robe_atributi_roba', function (Blueprint $table) {
            $table->id();

            $table->foreignId('roba_id')
                ->constrained('robe')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('atribut_id')
                ->constrained('atributi_roba')
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
        Schema::dropIfExists('robe_atributi_roba');
    }
}
