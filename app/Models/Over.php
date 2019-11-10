<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 8:56 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Over extends Model
{
    protected $table = 'overs';

    function bowler () {
        return $this->belongsTo(Player::class, 'bowler_id', 'id');
    }

    function match () {
        return $this->belongsTo(Match::class, 'match_id', 'id');
    }
}