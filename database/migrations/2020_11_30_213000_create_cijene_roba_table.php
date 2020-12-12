<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCijeneRobaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cijene_roba', function (Blueprint $table) {
            $table->id();
            $table->decimal('nabavna_cijena_bez_pdv', 15, 2)->nullable();
            $table->decimal('nabavna_cijena_sa_pdv', 15, 2)->nullable();
            $table->decimal('cijena_bez_pdv', 15, 2)->nullable();
            $table->decimal('ukupna_cijena', 15, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('porez_id')
                ->constrained('porezi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('roba_id')
                ->constrained('robe')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('atribut_id')
                ->constrained('atributi_roba')
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
        Schema::dropIfExists('cijene_roba');
    }
}
