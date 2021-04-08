<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCijenaBezPdvPopustToStavkeRacunaTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stavke_racuna', function (Blueprint $table) {
            $table->decimal('cijena_bez_pdv_popust', 15, 4);
            $table->decimal('cijena_sa_pdv_popust', 15, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stavke_racuna', function (Blueprint $table) {
            //
        });
    }
}
