<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodesavanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podesavanja', function (Blueprint $table) {
            $table->id();
            $table->integer('redni_broj')->nullable();
            $table->boolean('slanje_kupcu')->default(false);
            $table->string('izgled_racuna')->nullable();
            $table->enum('jezik', ['Crnogorski', 'English']);
            $table->string('boja')->nullable();
            $table->enum('mod', ['Svijetli', 'Tamni', 'Automatski']);

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('podesavanjas');
    }
}
