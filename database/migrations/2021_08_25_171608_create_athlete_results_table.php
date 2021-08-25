<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id');
            $table->foreign('league_id')->references('id')->on('leagues');
            $table->unsignedBigInteger('athlete_id');
            $table->foreign('athlete_id')->references('id')->on('users');

            $table->string('proof_photo');
            $table->string('type');
            $table->string('weight_class');

            $table->integer('hours')->default(0);
            $table->integer('minutes')->default(0);
            $table->integer('seconds');
            $table->integer('tenths');

            $table->integer('distance')->comment('distance in meters');

            $table->date('workout_date');

            $table->mediumText('comments');

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
        Schema::dropIfExists('athlete_results');
    }
}
