<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/1/2019
 * Time: 7:53 PM
 */

namespace App\Utilities;

class TournamentMatchScheduler
{
    static function schedule ($teamsIds) {
        if (count($teamsIds) % 2 == 0) {
            shuffle($teamsIds);
            $schedules = [];
            $half = count($teamsIds)/2;
            for ($i=0; $i<$half; $i++) {
                array_push($schedules, ['team1' => $teamsIds[$i], 'team2' => $teamsIds[$i + $half]]);
            }
            return $schedules;
        }
        return false;
    }
}