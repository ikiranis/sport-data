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
            $table->uuid('id');
            $table->string('slug');
            $table->uuid('sport_id');
            $table->uuid('photo_id')->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->integer('birthyear')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->smallInteger('height')->nullable();
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
        Schema::dropIfExists('athletes');
    }
}
