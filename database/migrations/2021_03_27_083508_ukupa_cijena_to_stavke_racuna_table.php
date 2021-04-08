<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UkupaCijenaToStavkeRacunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stavke_racuna', function (Blueprint $table) {
            $table->decimal('ukupna_bez_pdv', 15, 4);
            $table->decimal('ukupna_sa_pdv_popust', 15, 4);
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
