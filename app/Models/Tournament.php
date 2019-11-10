<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 7:42 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table = 'tournaments';

    function teams () {
        return $this->belongsToMany(Team::class, 'tournament_team', 'tournament_id', 'team_id');
    }

    function matches () {
        return $this->hasMany(Match::class, 'tournament_id', 'id');
    }

}