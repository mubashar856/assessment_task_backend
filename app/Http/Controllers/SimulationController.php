<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 9:52 PM
 */

namespace App\Http\Controllers;


use App\Components\MatchComponent;
use App\Components\ScoreTypeComponent;
use App\Components\TournamentComponent;
use App\Enums\MatchStatus;
use App\Enums\ScoreName;

class SimulationController
{
    private $tournamentComponent, $matchComponent, $scoreTypeComponent;

    public function __construct(TournamentComponent $tournamentComponent, MatchComponent $matchComponent, ScoreTypeComponent $scoreTypeComponent)
    {
        $this->tournamentComponent = $tournamentComponent;
        $this->matchComponent = $matchComponent;
        $this->scoreTypeComponent = $scoreTypeComponent;
    }

    function simulate()
    {
//        Fetching all tournaments to simulate
        $tournaments = $this->tournamentComponent->getAllTournaments();
        foreach ($tournaments as $tournament) {
            foreach ($tournament->matches as $match) {
                if ($match->status != MatchStatus::$SCHEDULED) {
                    continue;
                }
//                Initializing Match
                $this->matchComponent->startMatch($match->id);
//                starting first inning with team1 batting
                $this->startInning($match->id, $match->team1, $match->team2);
//                starting second inning with team2 batting
                $this->startInning($match->id, $match->team2, $match->team1);
                $this->matchComponent->finishMatch($match->id);
            }
        }
    }

    function startInning($matchId, $battingTeam, $bowlingTeam)
    {
        $batsmen = $battingTeam->players->toArray();
        $bowlers = $bowlingTeam->players->toArray();
        $bowlerNumber = 0;
        $batsmanNumber = 1;
        $currentBatsmen = array_slice($batsmen, 0, 2);
        $facingBatsman = $currentBatsmen[0];
        $totalOvers = 5;
        for ($over = 1; $over <= $totalOvers; $over++) {
            $balls = [];
            $bowler = $this->getBowler($bowlerNumber, $bowlers);
            $ballNumber = 0;
            while (count($balls) < 6) {
                $ballNumber++;
                $ball = $this->ball();
                $score = $ball['score'];
                $score += $ball['name'] == ScoreName::$RUNNING ? rand(1, 3) : 0;
                $this->matchComponent->addMatchHistory($matchId, $bowler['id'], $facingBatsman['id'], $battingTeam->id, $bowlingTeam->id, $ballNumber, $score, $ball['id']);
                if (!in_array($ball['name'], [ScoreName::$NO_BALL, ScoreName::$WIDE_BALL])) {
                    array_push($balls, 1);
                }
                if (in_array($ball['name'], [ScoreName::$CATCH_OUT, ScoreName::$RUN_OUT, ScoreName::$OUT])) {
                    if ($batsmanNumber == count($batsmen) - 1) {
                        return;
                    }
                    $currentBatsmen[0] = $batsmen[$batsmanNumber + 1];
                    $facingBatsman = $currentBatsmen[0];
                    $batsmanNumber++;
                }
                if (!in_array($ball['name'], [ScoreName::$WIDE_BALL, ScoreName::$NO_BALL]) && $score % 2 != 0) {
                    $currentBatsmen[0] = $currentBatsmen[1];
                    $currentBatsmen[1] = $facingBatsman;
                    $facingBatsman = $currentBatsmen[0];
                }
                $this->matchComponent->updateMatchStats($matchId);
                sleep(3);
            }
            $currentBatsmen[0] = $currentBatsmen[1];
            $currentBatsmen[1] = $facingBatsman;
            $facingBatsman = $currentBatsmen[0];
            $bowlerNumber++;
        }
    }

    private function ball()
    {
        $scoreTypes = $this->scoreTypeComponent->getScoreTypes()->toArray();
        return $scoreTypes[rand(0, count($scoreTypes) - 1)];
    }

    private function getBowler($bowlerNumber, $bowlers)
    {
        return $bowlerNumber < count($bowlers) ? $bowlers[$bowlerNumber + 1] : $bowlers[0];
    }
}