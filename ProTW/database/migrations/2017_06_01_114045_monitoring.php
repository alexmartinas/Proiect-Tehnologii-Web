<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Monitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('child_id');

            $table->foreign('user_id')
                  ->reference('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('child_id')
                ->reference('id')
                ->on('children')
                ->onDelete('cascade');
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
