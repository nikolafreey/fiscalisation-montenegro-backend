<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartneriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partneri', function (Blueprint $table) {
            $table->id();
            $table->string('kontakt_ime', 50);
            $table->string('kontakt_prezime', 50);
            $table->string('kontakt_telefon', 50);
            $table->boolean('kontakt_viber');
            $table->boolean('kontakt_whatsapp');
            $table->boolean('kontakt_facetime');
            $table->text('opis');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('fizicko_lice_id')
                ->nullable()
                ->constrained('fizicka_lica')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('preduzece_id')
                ->nullable()
                ->constrained('preduzeca')
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
        Schema::dropIfExists('partners');
    }
}
