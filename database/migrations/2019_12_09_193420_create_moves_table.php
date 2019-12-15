<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('move');
            $table->time('play_time')->nullable();
            $table->timestamp('play_time_start')->nullable();
            $table->char('status', '1')->nullable();

            $table->bigInteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');

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
        Schema::dropIfExists('moves');
    }
}
