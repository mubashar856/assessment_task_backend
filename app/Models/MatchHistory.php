<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 8:57 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MatchHistory extends Model
{
    protected $table = 'match_history';

    function over () {
        return $this->belongsTo(Over::class, 'over_id', 'id');
    }

    function bowler () {
        return $this->belongsTo(Player::class, 'bowler_id', 'id');
    }

    function batsman () {
        return $this->belongsTo(Player::class, 'batsman_id', 'id');
    }

    function scoreType () {
        return $this->belongsTo(ScoreType::class, 'score_type_id', 'id');
    }

    function ExtraScoreType () {
        return $this->belongsTo(ScoreType::class, 'extra_score_type_id', 'id');
    }
}