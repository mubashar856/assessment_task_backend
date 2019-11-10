<?php

namespace App\Components;


use App\Repositories\TeamRepository;

class TeamComponent
{
    private $repository;
    public function __construct()
    {
        $this->repository = new TeamRepository();
    }

    function getTeams () {
        return $this->repository->all();
    }
}