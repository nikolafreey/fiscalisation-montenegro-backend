<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PdvUkupno2ToStavkeRacunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stavke_racuna', function (Blueprint $table) {
            $table->decimal('pdv_iznos_ukupno', 15, 4);
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
