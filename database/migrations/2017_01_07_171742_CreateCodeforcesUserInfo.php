<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeforcesUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeforces_users', function (Blueprint $table) {
            $table->string('handle');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('country');
            $table->string('city');
            $table->string('organization');
            $table->string('avatar');
            $table->integer('rating');
            $table->string('rank');
            $table->integer('maxRating');
            $table->string('maxRank');
            $table->string('titlePhoto');
            $table->integer('contribution');
            $table->integer('friendOfCount');
            $table->integer('registrationTimeSeconds');
            $table->integer('lastOnlineTimeSeconds');

            $table->primary('handle');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('codeforcesHandle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codeforces_users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('codeforcesHandle');
        });
    }
}
