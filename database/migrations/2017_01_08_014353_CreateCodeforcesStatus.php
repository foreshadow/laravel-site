<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeforcesStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeforces_statuses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('handle');
            $table->integer('contestId');
            $table->string('index');
            $table->string('name');
            $table->string('testset');
            $table->string('verdict');
            $table->integer('passedTestCount');
            $table->string('programmingLanguage');
            $table->integer('timeConsumedMillis');
            $table->integer('memoryConsumedBytes');
            $table->integer('creationTimeSeconds');
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
        Schema::dropIfExists('codeforces_statuses');
    }
}
