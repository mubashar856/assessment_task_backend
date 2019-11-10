<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';

    function team1 () {
        return $this->belongsTo(Team::class, 'team1_id', 'id');
    }

    function team2 () {
        return $this->belongsTo(Team::class, 'team2_id', 'id');
    }

    function tournament () {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }

    function stats () {
        return $this->hasOne(MatchStats::class, 'match_id', 'id');
    }

}
