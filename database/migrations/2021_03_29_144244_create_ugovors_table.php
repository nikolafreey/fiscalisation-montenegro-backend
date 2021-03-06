<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUgovorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ugovori', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('file');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
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
        Schema::dropIfExists('ugovors');
    }
}
