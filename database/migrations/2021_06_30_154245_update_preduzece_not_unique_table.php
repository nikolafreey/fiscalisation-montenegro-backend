<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePreduzeceNotUniqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->dropUnique('preduzeca_skype_username_unique');
            $table->dropUnique('preduzeca_facebook_username_unique');
            $table->dropUnique('preduzeca_instagram_username_unique');
            $table->dropUnique('preduzeca_twitter_username_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
