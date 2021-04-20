<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStavkeRacunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavke_racuna', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->text('opis')->nullable();
            $table->decimal('jedinicna_cijena_bez_pdv', 15, 4);
            $table->integer('bar_code');
            $table->decimal('jedinicna_cijena_sa_pdv', 15, 4);
            $table->decimal('cijena_bez_pdv', 15, 4);
            $table->decimal('kolicina', 15, 3);
            $table->decimal('pdv_iznos', 15, 4);
            $table->decimal('popust_procenat', 15, 2)->nullable();
            $table->decimal('popust_iznos', 15, 4)->nullable();
            $table->boolean('popust_na_jedinicnu_cijenu')->nullable();
            $table->decimal('cijena_sa_pdv', 15, 4);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('porez_id')
                ->constrained('porezi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('jedinica_id')
                ->constrained('jedinice_mjere')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('racun_id')
                ->constrained('racuni')
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
        Schema::dropIfExists('stavka_racunas');
    }
}
