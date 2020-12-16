<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStavkeUlazniRacuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavke_ulazni_racuni', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->text('opis', 50)->nullable();
            $table->decimal('jedinicna_cijena_bez_pdv', 15, 2);
            $table->decimal('kolicina', 15, 2);
            $table->decimal('pdv_iznos', 15, 2);
            $table->boolean('odbitni_pdv');
            $table->decimal('popust_procenat', 15, 2)->nullable();
            $table->decimal('popust_iznos', 15, 2)->nullable();
            $table->boolean('popust_na_jedinicnu_cijenu')->nullable();
            $table->decimal('cijena_sa_pdv', 15, 2);
            $table->timestamps();

            $table->foreignId('porez_id')
                ->constrained('porezi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('jedinica_id')
                ->constrained('jedinice_mjere')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('ulazni_racun_id')
                ->constrained('ulazni_racuni')
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
