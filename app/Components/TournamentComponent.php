<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/8/2019
 * Time: 9:37 PM
 */

namespace App\Components;


use App\Repositories\TournamentRepository;

class TournamentComponent
{
    private $repository;
    public function __construct()
    {
        $this->repository = new TournamentRepository();
    }

    function getAllTournaments () {
        return $this->repository->allTournaments();
    }

    function first () {
        return $this->repository->first();
    }
}