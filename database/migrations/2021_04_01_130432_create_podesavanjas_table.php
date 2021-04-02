<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodesavanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podesavanja', function (Blueprint $table) {
            $table->id();
            $table->integer('redniBroj')->nullable();
            $table->boolean('slanjeKupcu')->default(false);
            $table->string('izgledRacuna')->nullable();
            $table->enum('jezik', ['Crnogorski', 'English']);
            $table->string('boja')->nullable();
            $table->enum('mod', ['Svijetli', 'Tamni', 'Automatski']);

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('podesavanjas');
    }
}
