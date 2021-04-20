<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoslovnaJedinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poslovne_jedinice', function (Blueprint $table) {
            $table->id();
            $table->string('kratki_naziv', 100);
            $table->string('adresa', 50)->nullable();
            $table->string('grad', 50)->nullable();
            $table->string('drzava', 50)->nullable();

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('poslovne_jedinice');
    }
}
