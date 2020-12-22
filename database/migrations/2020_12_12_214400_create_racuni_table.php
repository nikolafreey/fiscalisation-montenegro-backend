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
            $table->string('kod_operatera', 50)->nullable();
            $table->string('kod_poslovnog_prostora', 50)->nullable();
            $table->string('ikof', 50)->nullable();
            $table->string('jikr', 50)->nullable();
            $table->string('tip_racuna', 50);
            $table->string('vrsta_racuna', 50);
            $table->boolean('korektivni_racun', 50)->default(false);
            $table->string('korektivni_racun_vrsta', 50)->nullable();
            $table->integer('broj_racuna');
            $table->dateTime('datum_izdavanja');
            $table->dateTime('datum_za_placanje')->nullable();
            $table->string('kod_poslovnog_prostora_enu', 50)->nullable();
            $table->decimal('ukupna_cijena_bez_pdv', 15, 2);
            $table->decimal('ukupna_cijena_sa_pdv', 15, 2);
            $table->decimal('ukupan_iznos_pdv', 15, 2);
            $table->decimal('popust_procenat', 15, 2)->nullable();
            $table->decimal('popust_iznos', 15, 2)->nullable();
            $table->boolean('popust_na_cijenu_bez_pdv')->nullable();
            $table->decimal('popust_ukupno', 15, 2)->nullable();
            $table->text('opis')->nullable();
            $table->string('status', 20);
            $table->softDeletes();
            $table->timestamps();

            $table->uuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->uuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('partner_id')
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
