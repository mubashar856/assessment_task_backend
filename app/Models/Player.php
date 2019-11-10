<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 7:41 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    function teams () {
        return $this->belongsToMany(Team::class, 'player_team', 'player_id', 'team_id');
    }

}