<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamToEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_to_evidence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('evidence_id')->unsigned();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('evidence_id')->references('id')->on('evidences');
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
        Schema::dropIfExists('team_to_evidence');
    }
}
