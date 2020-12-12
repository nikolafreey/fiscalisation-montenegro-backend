<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTipKorisnikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tip_korisnika', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('preduzece_id')
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
                $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
                $table->foreignId('tip_korisnika_id')
                ->constrained('tipovi_korisnika')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
                $table->timestamps();

                $table->unique(['preduzece_id', 'user_id']);

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tip_korisnika');
    }
}
