<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoreziZaUlazniRacunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porezi_za_ulazni_racun', function (Blueprint $table) {
            $table->id();
            $table->decimal('pdv_iznos_ukupno', 20, 10);
            $table->decimal('neodbitni_pdv_ukupno', 20, 10);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('ulazni_racun_id')
                ->constrained('ulazni_racuni')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('porez_id')
                ->constrained('porezi')
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
        Schema::dropIfExists('porezi_za_racun');
    }
}
