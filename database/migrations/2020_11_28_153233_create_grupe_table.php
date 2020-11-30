<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupe', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 50);
            $table->text('opis');
            $table->decimal('popust_procenti', 4, 2);
            $table->decimal('popust_iznos', 15, 2);
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
        Schema::dropIfExists('grupe');
    }
}
