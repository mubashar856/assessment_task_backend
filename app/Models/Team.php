<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 7:41 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    function players () {
        return $this->belongsToMany(Player::class, 'player_team', 'team_id', 'player_id');
    }

    function matchesAsFirst() {
        return $this->hasMany(Match::class, 'team1_id', 'id');
    }

    function matchesAsSecond() {
        return $this->hasMany(Match::class, 'team2_id', 'id');
    }

    function matches () {
        return $this->matchesAsFirst()->union($this->matchesAsSecond()->toBase());
    }

    function tournaments () {
        return $this->belongsToMany(Tournament::class, 'tournament_team', 'team_id', 'tournament_id');
    }

}