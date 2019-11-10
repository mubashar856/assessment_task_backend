<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_history', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('match_id')->unsigned();
            $table->bigInteger('bowler_id')->unsigned();
            $table->bigInteger('batsman_id')->unsigned();
            $table->bigInteger('batting_team_id')->unsigned();
            $table->bigInteger('bowling_team_id')->unsigned();
            $table->integer('ball_number');
            $table->string('ball_type');
            $table->string('remarks')->nullable();
            $table->integer('score');
            $table->bigInteger('score_type_id')->unsigned();
            $table->boolean('is_extra_score')->default(false);
            $table->bigInteger('extra_score_type_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('bowler_id')->references('id')->on('players');
            $table->foreign('batsman_id')->references('id')->on('players');
            $table->foreign('batting_team_id')->references('id')->on('teams');
            $table->foreign('bowling_team_id')->references('id')->on('teams');
            $table->foreign('score_type_id')->references('id')->on('score_types');
            $table->foreign('extra_score_type_id')->references('id')->on('score_types');
            $table->index(['match_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_history');
    }
}
