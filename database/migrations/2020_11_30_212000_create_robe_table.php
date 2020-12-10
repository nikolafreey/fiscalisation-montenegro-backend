<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobeTable extends Migration
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
            $table->string('opis', 255)->nullable();
            $table->string('detaljni_opis', 255)->nullable();
            $table->string('ean', 50)->nullable();
            $table->string('interna_sifra_proizvoda', 50)->nullable();
            $table->boolean('status')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('proizvodjac_robe_id')
                ->constrained('proizvodjaci_roba')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('jedinica_mjere_id')
                ->constrained('jedinice_mjere')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
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
