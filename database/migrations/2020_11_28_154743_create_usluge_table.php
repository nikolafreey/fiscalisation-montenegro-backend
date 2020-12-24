<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUslugeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usluge', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->text('opis')->nullable();
            $table->decimal('cijena_bez_pdv', 15, 2);
            $table->decimal('ukupna_cijena', 15, 2);
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();

            $table->uuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('grupa_id')
                ->nullable()
                ->constrained('grupe')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('jedinica_mjere_id')
                ->constrained('jedinice_mjere')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('porez_id')
                ->constrained('porezi')
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
        Schema::dropIfExists('usluge');
    }
}
