<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvlascenaLicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ovlascena_lica', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 50);
            $table->string('prezime', 50);
            $table->string('telefon', 50);
            $table->boolean('telefon_viber');
            $table->boolean('telefon_whatsapp');
            $table->boolean('telefon_facetime');
            $table->string('email', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ovlascena_licea');
    }
}
