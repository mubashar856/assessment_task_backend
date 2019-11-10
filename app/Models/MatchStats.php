<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 8:56 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MatchStats extends Model
{
    protected $table = 'match_stats';

    function match () {
        return $this->belongsTo(Match::class, 'match_id', 'id');
    }

    function winningTeam () {
        return $this->belongsTo(Team::class, 'winning_team_id', 'id');
    }

}