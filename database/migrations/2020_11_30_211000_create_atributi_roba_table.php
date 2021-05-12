<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributiRobaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributi_roba', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->string('opis', 255)->nullable();
            $table->decimal('popust_procenti', 15, 2)->nullable();
            $table->decimal('popust_iznos', 20, 10)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('tip_atributa_id')
                ->constrained('tipovi_atributa_roba')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreignUuid('preduzece_id')
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
        Schema::dropIfExists('atributi_roba');
    }
}
