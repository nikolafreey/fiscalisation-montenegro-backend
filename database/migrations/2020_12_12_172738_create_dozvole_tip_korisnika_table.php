<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDozvoleTipKorisnikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dozvole_tip_korisnika', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tip_korisnika_id')
                ->constrained('tipovi_korisnika')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('model', 50);
            $table->boolean('can_read')->default(false);
            $table->boolean('can_create')->default(false);
            $table->boolean('can_edit')->default(false);
            $table->boolean('can_delete')->default(false);
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
        Schema::dropIfExists('dozvole_tip_korisnika');
    }
}
