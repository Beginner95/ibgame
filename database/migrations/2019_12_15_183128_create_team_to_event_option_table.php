<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamToEventoptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_to_event_option', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('event_option_id')->unsigned();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('event_option_id')->references('id')->on('event_options');
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
        Schema::dropIfExists('team_to_event_option');
    }
}
