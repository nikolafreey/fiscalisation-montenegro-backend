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
            $table->string('kod_operatera', 50);
            $table->string('kod_poslovnog_prostora', 50);
            $table->string('ikof', 50);
            $table->string('jikr', 50);
            $table->string('tip_racuna', 50);
            $table->string('vrsta_racuna', 50);
            $table->boolean('korektivni_racun', 50);
            $table->string('korektivni_racun_vrsta', 50)->nullable();
            $table->integer('broj_racuna');
            $table->dateTime('datum_izdavanja');
            $table->dateTime('datum_za_placanje');
            $table->string('kod_poslovnog_prostora_enu', 50);
            $table->decimal('ukupna_cijena_bez_pdv', 15, 2);
            $table->decimal('ukupna_cijena_sa_pdv', 15, 2);
            $table->decimal('ukupan_iznos_pdv', 15, 2);
            $table->decimal('popust_procenat', 15, 2);
            $table->decimal('popust_iznos', 15, 2);
            $table->boolean('popust_na_cijenu_bez_pdv');
            $table->decimal('popust_ukupno', 15, 2);
            $table->text('opis');
            $table->string('status', 20);
            $table->timestamps();

            $table->uuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->uuid('user_id')
                ->constrained('users')
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
