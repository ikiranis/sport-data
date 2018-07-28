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
            $table->uuid('id');
            $table->uuid('sport_id');
            $table->uuid('championship_id');
            $table->uuid('season_id');
            $table->dateTime('match_date')->nullable();
            $table->uuid('matchday_id');
            $table->uuid('stadium_id')->nullable();
            $table->uuid('first_team_id');
            $table->uuid('second_team_id');
            $table->integer('first_team_score')->unsigned()->nullable();
            $table->integer('first_team_score_1')->unsigned()->nullable();
            $table->integer('first_team_score_2')->unsigned()->nullable();
            $table->integer('first_team_score_3')->unsigned()->nullable();
            $table->integer('first_team_score_4')->unsigned()->nullable();
            $table->integer('first_team_score_5')->unsigned()->nullable();
            $table->integer('second_team_score')->unsigned()->nullable();
            $table->integer('second_team_score_1')->unsigned()->nullable();
            $table->integer('second_team_score_2')->unsigned()->nullable();
            $table->integer('second_team_score_3')->unsigned()->nullable();
            $table->integer('second_team_score_4')->unsigned()->nullable();
            $table->integer('second_team_score_5')->unsigned()->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('matches');
    }
}
