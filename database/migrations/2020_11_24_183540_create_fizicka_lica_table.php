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
            $table->string('ib', 8);
            $table->string('adresa', 50);
            $table->string('grad', 50);
            $table->string('drzava', 50);

            $table->string('telefon', 50);
            $table->boolean('telefon_viber');
            $table->boolean('telefon_whatsapp');
            $table->boolean('telefon_facetime');
            $table->string('email', 191);
            $table->string('zanimanje', 191);
            $table->string('radno_mjesto', 50);
            $table->string('drzavljanstvo', 50);
            $table->string('nacionalnost', 50);
            $table->string('cv_link', 255);
            $table->string('avatar', 255);

            $table->foreignId('preduzece_id')
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
        Schema::dropIfExists('fizicko_lices');
    }
}
