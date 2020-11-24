<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
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
            $table->timestamps();
            $table->string('kontakt_ime',50);
            $table->string('kontakt_prezime',50);
            $table->string('kontakt_telefon',50);
            $table->boolean('kontakt_viber');
            $table->boolean('kontakt_whatsapp');
            $table->boolean('kontakt_facetime');
            $table->text('opis');
            
            $table->foreignId('user_id')
                ->constrained('user')
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
        Schema::dropIfExists('partners');
    }
}
