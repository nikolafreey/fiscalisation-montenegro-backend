<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepozitWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depozit_withdraws', function (Blueprint $table) {
            $table->id();
            $table->decimal('iznos_depozit', 15, 4)->nullable();
            $table->decimal('iznos_withdraw', 15, 4)->nullable();
            $table->boolean('fiskalizovan')->default(false);
            $table->timestamps();

            $table->foreignId('poslovna_jedinica_id')
                ->constrained('poslovne_jedinice')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('preduzece_id')
                ->nullable()
                ->constrained('preduzeca')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreignUuid('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('depozit_withdraws');
    }
}
