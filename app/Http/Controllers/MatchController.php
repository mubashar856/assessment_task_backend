<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 5:03 PM
 */

namespace App\Http\Controllers;


use App\Components\MatchComponent;
use App\Http\Resources\MatchHistory;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    private $component;
    public function __construct(MatchComponent $matchComponent)
    {
        $this->component = $matchComponent;
    }

    function getMatchHistory (Request $request) {
        $matchHistory = $this->component->getMatchHistory($request['matchId']);
        return MatchHistory::collection($matchHistory);
    }

    function scheduleMatches () {
        $this->component->scheduleMatches();
    }
}