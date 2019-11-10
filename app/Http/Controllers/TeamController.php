<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/10/2019
 * Time: 4:42 PM
 */

namespace App\Http\Controllers;


use App\Components\TeamComponent;
use App\Http\Resources\Team;

class TeamController extends Controller
{
    private $component;
    public function __construct(TeamComponent $teamComponent)
    {
        $this->component = $teamComponent;
    }

    function getTeams () {
        return Team::collection($this->component->getTeams());
    }
}