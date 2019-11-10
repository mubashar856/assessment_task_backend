<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 5:07 PM
 */

namespace App\Repositories;


use App\Enums\BallType;
use App\Models\MatchHistory;

class MatchHistoryRepository extends Repository
{
    public function __construct()
    {
        $this->model = new MatchHistory();
    }

    function getByMatchId ($matchId) {
        return $this->model->with(['bowler', 'batsman', 'scoreType'])->where('match_id', $matchId)->get();
    }

    function getByMatchBatsmen ($matchId, $batsmanIds) {
        return $this->model->where('match_id', $matchId)->whereIn('batsman_id', $batsmanIds)->get();
    }

    function add ($matchId, $bowlerId, $batsmanId, $battingTeamId, $bowlingTeamId, $ballNumber, $score, $scoreTypeId) {
        $record = new $this->model();
        $record->match_id = $matchId;
        $record->bowler_id = $bowlerId;
        $record->batsman_id = $batsmanId;
        $record->batting_team_id = $battingTeamId;
        $record->bowling_team_id = $bowlingTeamId;
        $record->ball_number = $ballNumber;
        $record->ball_type = BallType::$REGULAR;
        $record->remarks = '';
        $record->score = $score;
        $record->score_type_id = $scoreTypeId;
        $record->is_extra_score = false;
        $record->extra_score_type_id = null;
        return $record->save();
    }
}