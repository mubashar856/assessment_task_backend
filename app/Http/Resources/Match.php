<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Match extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'result' => $this->result,
            'matchTime' => $this->match_time,
            'team1' => new Team($this->team1),
            'team2' => new Team($this->team2),
            'stats' => new MatchStats($this->stats),
        ];
    }
}
