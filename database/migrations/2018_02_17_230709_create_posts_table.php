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
            $table->uuid('id');
            $table->string('slug');
            $table->uuid('team_id')->nullable();
            $table->uuid('photo_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->uuid('athlete_id')->nullable();
            $table->uuid('match_id')->nullable();
            $table->uuid('sport_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('body');
            $table->string('reference')->nullable();
            $table->boolean('approved')->default(false);
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
        Schema::dropIfExists('posts');
    }
}
