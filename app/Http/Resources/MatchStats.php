<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchStats extends JsonResource
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
            'team1Score' => $this->team1_score,
            'team1Wickets' => $this->team1_wickets,
            'team1Overs' => $this->team1_overs,
            'team2Wickets' => $this->team2_wickets,
            'team2Score' => $this->team2_score,
            'team2Overs' => $this->team2_overs,
            'winningTeam' => new Team($this->winningTeam),
        ];
    }
}
