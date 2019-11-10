<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 10:11 PM
 */

namespace App\Repositories;


use App\Models\ScoreType;

class ScoreTypeRepository extends Repository
{

    public function __construct()
    {
        $this->model = new ScoreType();
    }

}