<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobeKategorijePodKategorijeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robe_kategorije_podkategorije', function (Blueprint $table) {
            $table->id();

            $table->foreignId('roba_id')
                ->constrained('robe')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('kategorija_robe_id')
                ->constrained('kategorije_roba')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('podkategorija_robe_id')
                ->nullable()
                ->constrained('podkategorije_roba')
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
        Schema::dropIfExists('robe_kategorije_podkategorije');
    }
}
