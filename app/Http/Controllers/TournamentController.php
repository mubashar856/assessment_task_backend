<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/8/2019
 * Time: 9:35 PM
 */

namespace App\Http\Controllers;


use App\Components\TournamentComponent;
use App\Http\Resources\Tournament;

class TournamentController extends Controller
{
    private $component;
    public function __construct(TournamentComponent $component)
    {
        $this->component = $component;
    }

    function getTournaments () {
        $tournaments = $this->component->getAllTournaments();
        return Tournament::collection($tournaments);
    }

}