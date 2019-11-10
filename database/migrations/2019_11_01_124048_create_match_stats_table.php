<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_stats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('match_id')->unsigned();
            $table->bigInteger('winning_team_id')->nullable()->unsigned();
            $table->integer('team1_score');
            $table->integer('team1_wickets');
            $table->float('team1_overs');
            $table->integer('team2_wickets');
            $table->integer('team2_score');
            $table->float('team2_overs');
            $table->timestamps();
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('winning_team_id')->references('id')->on('teams');
            $table->index('match_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_stats');
    }
}
