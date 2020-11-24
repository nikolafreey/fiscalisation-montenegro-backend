<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreduzeceDjelatnostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preduzece_djelatnost', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('djelatnost_id')
                ->constrained('djelatnosti')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('preduzece_id')
            ->constrained('preduzeca')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
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
        Schema::dropIfExists('preduzece_djelatnost');
    }
}
