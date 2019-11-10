<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/8/2019
 * Time: 9:35 PM
 */

namespace App\Repositories;


use App\Models\Tournament;

class TournamentRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Tournament();
    }

    public function allTournaments () {
        return $this->model->with(['matches.team1', 'matches.team2', 'matches.stats', 'matches.stats.winningTeam'])->get();
    }
}