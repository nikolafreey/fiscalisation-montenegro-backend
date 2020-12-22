<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoreziZaRacunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porezi_za_racun', function (Blueprint $table) {
            $table->id();
            $table->decimal('pdv_iznos_ukupno', 15, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('racun_id')
                ->constrained('racuni')
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
