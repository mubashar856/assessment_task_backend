<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ballNumber' => $this->ball_number,
            'ballType' => $this->ball_type,
            'remarks' => $this->remarks,
            'score' => $this->score,
            'battingTeamId' => $this->batting_team_id,
            'bowlingTeamId' => $this->bowling_team_id,
            'scoreType' => new ScoreType($this->scoreType),
            'bowler' => new Player($this->bowler),
            'batsman' => new Player($this->batsman),
        ];
    }
}
