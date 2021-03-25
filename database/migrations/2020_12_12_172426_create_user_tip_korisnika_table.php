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

            $table->foreignUuid('preduzece_id')
                ->nullable()
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('poslovna_jedinica_id')
                ->nullable()
                ->constrained('poslovne_jedinice')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('tip_korisnika_id')
                ->nullable()
                ->constrained('tipovi_korisnika')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
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
