<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreduzeceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preduzeca', function (Blueprint $table) {
            $table->id();
            $table->string('kratki_naziv', 50)->unique();
            $table->string('puni_naziv', 100);
            $table->string('oblik_preduzeca', 50);
            $table->string('adresa', 50);
            $table->string('grad', 50);
            $table->string('drzava', 50);
            $table->string('telefon', 50);
            $table->boolean('telfon_viber');
            $table->boolean('telfon_whatsapp');
            $table->boolean('telfon_facetime');
            $table->string('fax', 50);
            $table->string('email', 191);
            $table->string('website', 191);
            $table->string('pib', 50)->unique();
            $table->string('pdv', 50)->unique();
            $table->string('djelatnost', 50);
            $table->string('iban', 50);
            $table->string('bic_swift', 50);
            $table->string('kontakt_ime', 50);
            $table->string('kontakt_prezime', 50);
            $table->string('kontakt_telefon', 50);
            $table->boolean('kontakt_viber');
            $table->boolean('kontakt_whatsapp');
            $table->boolean('kontakt_facetime');
            $table->string('kontakt_email', 50);
            $table->string('twitter_username', 100)->unique();
            $table->string('instagram_username', 100)->unique();
            $table->string('facebook_username', 100)->unique();
            $table->string('skype_username', 100)->unique();
            $table->string('logotip', 255);
            $table->text('opis');
            $table->string('lokacija_lat', 50);
            $table->string('lokacija_long', 50);
            $table->boolean('status');
            $table->boolean('privatnost');
            $table->boolean('verifikovan');
            $table->foreignId('kategorija_id')->constrained('kategorije');
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
        Schema::dropIfExists('preduzece');
    }
}
