<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvlascenoLicePreduzeceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ovlasceno_lice_preduzece', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ovlasceno_lice_id')
                ->constrained('ovlascena_lica')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignUuid('preduzece_id')
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
        Schema::dropIfExists('ovlasceno_lice_preduzece');
    }
}
