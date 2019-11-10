<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 9:14 PM
 */

namespace App\Repositories;


use App\Models\MatchStats;

class MatchStatsRepository extends Repository
{
    public function __construct()
    {
        $this->model = new MatchStats();
    }

    function add($matchId)
    {
        $record = new $this->model();
        $record->match_id = $matchId;
        $record->team1_score = 0;
        $record->team1_wickets = 0;
        $record->team1_overs = 0;
        $record->team2_score = 0;
        $record->team2_wickets = 0;
        $record->team2_overs = 0;
        return $record->save();
    }

    function update($matchId, $team1Score, $team1Wickets, $team1Overs, $team2Score, $team2Wickets, $team2Overs, $winningTeamId = null)
    {
        $record = $this->model->where('match_id', $matchId)->first();
        $record->team1_score = $team1Score;
        $record->team1_wickets = $team1Wickets;
        $record->team1_overs = $team1Overs;
        $record->team2_score = $team2Score;
        $record->team2_wickets = $team2Wickets;
        $record->team2_overs = $team2Overs;
        if ($winningTeamId != null) {
            $record->winning_team_id = $winningTeamId;
        }
        return $record->save();
    }

}