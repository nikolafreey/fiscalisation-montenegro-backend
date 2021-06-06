<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreduzecaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preduzeca', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kratki_naziv', 100);
            $table->string('puni_naziv', 100)->nullable();
            $table->string('oblik_preduzeca', 50);
            $table->string('adresa', 50)->nullable();
            $table->string('grad', 50)->nullable();
            $table->string('drzava', 50)->nullable();
            $table->string('telefon', 50)->nullable();
            $table->boolean('telefon_viber')->nullable();
            $table->boolean('telefon_whatsapp')->nullable();
            $table->boolean('telefon_facetime')->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('website', 191)->nullable();
            $table->string('pib', 50)->unique();
            $table->string('pdv', 50)->nullable();
            // $table->string('djelatnost', 50)->nullable();
            $table->string('iban', 50)->nullable();
            $table->string('bic_swift', 50)->nullable();
            $table->string('kontakt_ime', 50)->nullable();
            $table->string('kontakt_prezime', 50)->nullable();
            $table->string('kontakt_telefon', 50)->nullable();
            $table->boolean('kontakt_viber')->nullable();
            $table->boolean('kontakt_whatsapp')->nullable();
            $table->boolean('kontakt_facetime')->nullable();
            $table->string('kontakt_email', 50)->nullable();
            $table->string('twitter_username', 100)->nullable();
            $table->string('instagram_username', 100)->nullable();
            $table->string('facebook_username', 100)->nullable();
            $table->string('skype_username', 100)->nullable();
            $table->string('logotip')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('opis')->nullable();
            $table->string('lokacija_lat', 50)->nullable();
            $table->string('lokacija_long', 50)->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('privatnost')->nullable();
            $table->boolean('verifikovan')->default(false);
            $table->boolean('pdv_obveznik')->nullable();
            $table->string('pecat')->nullable();
            $table->string('sertifikat')->nullable();
            $table->text('pecatSifra')->nullable();
            $table->text('sertifikatSifra')->nullable();
            $table->string('enu_kod')->default('wp886vu280');
            $table->string('software_kod')->default('qk433mq872');
            $table->string('kod_operatera')->default('ia871me776');
            $table->string('kod_pj')->default('ya260ri698');
            $table->date('vazenje_pecata_do')->nullable();
            $table->date('vazenje_sertifikata_do')->nullable();
            $table->date('vazenje_paketa_do')->nullable();

            $table->foreignId('kategorija_id')
                ->constrained('kategorije')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('djelatnost_id')
                ->constrained('djelatnosti')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();
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
