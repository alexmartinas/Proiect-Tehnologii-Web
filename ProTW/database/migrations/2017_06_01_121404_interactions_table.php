<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('interactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_child');
            $table->integer('id_contact');
            $table->double('location_x',20,15);
            $table->double('location_y',20,15);
            $table->timestamp('date_i');
            $table->string('type_i');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
}
