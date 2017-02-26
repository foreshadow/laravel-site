<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeforcesContest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeforces_contests', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->string('type');
            $table->string('phase');
            $table->string('frozen');
            $table->integer('durationSeconds');
            $table->integer('startTimeSeconds');
            $table->integer('relativeTimeSeconds');
            
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codeforces_contests');
    }
}
