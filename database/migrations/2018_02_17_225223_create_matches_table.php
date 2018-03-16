<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sport_id')->unsigned();
            $table->integer('championship_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->dateTime('match_date')->nullable();
            $table->integer('matchday_id')->unsigned();
            $table->integer('stadium_id')->unsigned()->nullable();
            $table->integer('first_team_id')->unsigned();
            $table->integer('second_team_id')->unsigned();
            $table->integer('first_team_score')->unsigned()->nullable();
            $table->integer('second_team_score')->unsigned()->nullable();
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
        Schema::dropIfExists('matches');
    }
}
