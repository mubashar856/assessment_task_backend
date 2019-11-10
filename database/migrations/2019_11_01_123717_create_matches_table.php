<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('team1_id')->unsigned();
            $table->bigInteger('team2_id')->unsigned();
            $table->bigInteger('tournament_id')->unsigned();
            $table->dateTime('match_time');
            $table->string('status');
            $table->string('result')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->foreign('team1_id')->references('id')->on('teams');
            $table->foreign('team2_id')->references('id')->on('teams');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
