<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('ime', 50);
            $table->string('prezime', 50)->nullable();
            $table->string('jezik', 10)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->boolean('paket')->nullable();
            $table->date('vazi_do')->nullable();
            $table->string('kod_operatera')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
