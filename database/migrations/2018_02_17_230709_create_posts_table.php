<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('team_id')->unsigned()->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('athlete_id')->unsigned()->nullable();
            $table->integer('match_id')->unsigned()->nullable();
            $table->integer('sport_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('body');
            $table->string('reference')->nullable();
            $table->boolean('approved')->default(false);
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
        Schema::dropIfExists('posts');
    }
}
