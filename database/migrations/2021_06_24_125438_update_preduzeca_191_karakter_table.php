<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePreduzeca191KarakterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->string('kratki_naziv', 191)->change();
            $table->string('puni_naziv', 191)->change();
            $table->string('adresa', 191)->change();
            $table->string('grad', 191)->change();
            $table->string('drzava', 191)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
