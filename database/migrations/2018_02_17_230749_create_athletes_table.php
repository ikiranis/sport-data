<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sport_id')->unsigned();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->integer('birthyear')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->smallInteger('height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athletes');
    }
}
