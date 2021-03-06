<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFizickaLicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fizicka_lica', function (Blueprint $table) {
            $table->id();

            $table->string('ime', 50);
            $table->string('prezime', 50);
            $table->string('jmbg', 13);
            $table->string('ib', 8)->nullable();
            $table->string('adresa', 50)->nullable();
            $table->string('grad', 50)->nullable();
            $table->string('drzava', 50)->nullable();
            $table->string('telefon', 50)->nullable();
            $table->boolean('telefon_viber')->nullable();
            $table->boolean('telefon_whatsapp')->nullable();
            $table->boolean('telefon_facetime')->nullable();
            $table->string('email', 191)->nullable();
            $table->string('zanimanje', 191)->nullable();
            $table->string('radno_mjesto', 50)->nullable();
            $table->string('drzavljanstvo', 50)->nullable();
            $table->string('nacionalnost', 50)->nullable();
            $table->string('cv_link', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->boolean('status');

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignUuid('preduzece_id')
                ->constrained('preduzeca')
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
        Schema::dropIfExists('fizicka_lica');
    }
}
