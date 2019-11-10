<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 10:11 PM
 */

namespace App\Components;


use App\Repositories\ScoreTypeRepository;

class ScoreTypeComponent
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ScoreTypeRepository();
    }

    function getScoreTypes () {
        return $this->repository->all();
    }

}