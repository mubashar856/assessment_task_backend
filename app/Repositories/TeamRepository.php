<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/10/2019
 * Time: 4:43 PM
 */

namespace App\Repositories;


use App\Models\Team;

class TeamRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Team();
    }
}