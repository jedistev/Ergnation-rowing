<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Who created the league')->constrained();
            $table->string('name');
            $table->string('type')->comment('Type of league: Open or Private');
            $table->boolean('allow_join')->default(false)->comment('Allow join requests for everyone');
            $table->string('business');
            $table->string('category')->comment('Light Weight and Heavy Weight');
            $table->string('gender');
            $table->integer('age')->comment('age in years');
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
        Schema::dropIfExists('leagues');
    }
}
