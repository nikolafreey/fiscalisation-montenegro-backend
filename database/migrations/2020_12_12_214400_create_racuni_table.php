<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racuni', function (Blueprint $table) {
            $table->id();
            $table->string('ikof', 50)->nullable();
            $table->string('jikr', 50)->nullable();
            $table->string('qr_url', 200)->nullable();
            $table->string('tip_racuna', 50);
            $table->string('vrsta_racuna', 50);
            $table->boolean('korektivni_racun')->default(false);
            $table->string('korektivni_racun_vrsta', 50)->nullable();
            $table->string('nacin_placanja', 50)->nullable();
            $table->string('broj_racuna');
            $table->dateTime('datum_izdavanja');
            $table->dateTime('datum_za_placanje')->nullable();
            $table->string('kod_poslovnog_prostora_enu', 50)->nullable();
            $table->decimal('ukupna_cijena_bez_pdv', 15, 4)->default(0);
            $table->decimal('ukupna_cijena_bez_pdv_popust', 15, 4)->default(0);
            $table->decimal('ukupna_cijena_sa_pdv', 15, 4)->default(0);
            $table->decimal('ukupna_cijena_sa_pdv_popust', 15, 4)->default(0);
            $table->decimal('ukupan_iznos_pdv', 15, 4)->default(0);
            $table->decimal('popust_procenat', 15, 2)->nullable();
            $table->decimal('popust_iznos', 15, 4)->nullable();
            $table->boolean('popust_na_cijenu_bez_pdv')->nullable();
            $table->boolean('offline')->nullable();
            $table->boolean('order')->nullable();
            $table->decimal('popust_ukupno', 15, 4)->nullable();
            $table->text('opis')->nullable();
            $table->string('status', 20)->default('KREIRAN');
            $table->integer('redni_broj')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('poslovna_jedinica_id')
                ->nullable()
                ->constrained('poslovne_jedinice')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('partner_id')
                ->nullable()
                ->constrained('partneri')
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
        Schema::dropIfExists('racuni');
    }
}
