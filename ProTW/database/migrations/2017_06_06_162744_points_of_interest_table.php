<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointsOfInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('points_of_interest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_child');
            $table->string('name');
            $table->double('location_x',20,15);
            $table->double('location_y',20,15);
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
        Schema::dropIfExists('points_of_interest');
    }
}
