<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('modul_id')
                ->constrained('moduli')
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
        Schema::dropIfExists('modul_user');
    }
}
