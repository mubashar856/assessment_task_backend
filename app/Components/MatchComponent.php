<?php
/**
 * Created by PhpStorm.
 * User: mubashar.hassan
 * Date: 11/9/2019
 * Time: 5:06 PM
 */

namespace App\Components;


use App\Enums\MatchStatus;
use App\Enums\ScoreName;
use App\Events\MatchStatsEvent;
use App\Repositories\MatchHistoryRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MatchStatsRepository;
use App\Utilities\TournamentMatchScheduler;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchComponent
{
    private $matchHistoryRepository;
    private $matchStatsRepository;
    private $tournamentComponent;
    private $repository;

    public function __construct()
    {
        $this->matchHistoryRepository = new MatchHistoryRepository();
        $this->matchStatsRepository = new MatchStatsRepository();
        $this->repository = new MatchRepository();
        $this->tournamentComponent = new TournamentComponent();
    }

    function getMatchHistory($matchId)
    {
        return $this->matchHistoryRepository->getByMatchId($matchId);
    }

    function addMatchHistory($matchId, $bowlerId, $batsmanId, $battingTeamId, $bowlingTeamId, $ballNumber, $score, $scoreTypeId)
    {
        return $this->matchHistoryRepository->add($matchId, $bowlerId, $batsmanId, $battingTeamId, $bowlingTeamId, $ballNumber, $score, $scoreTypeId);
    }

    private function addMatchStats($matchId)
    {
        return $this->matchStatsRepository->add($matchId);
    }

    function updateMatchStats($matchId)
    {
        $match = $this->repository->first($matchId);
        list($team1Stats, $team2Stats) = $this->calculateMatchStats($match);
        $winningTeamId = null;
        if ($match->status == MatchStatus::$FINISHED) {
            $winningTeamId = $team1Stats['score'] > $team2Stats['score'] ? $team1Stats['id'] : $team2Stats['id'];
            $winningTeam = $team1Stats['score'] > $team2Stats['score'] ? $team1Stats['name'] : $team2Stats['name'];
            $this->updateMatch($matchId, ['remarks' => "$winningTeam won the match"]);
        }
        $this->matchStatsRepository->update($matchId, $team1Stats['score'], $team1Stats['wickets'], $team1Stats['overs'], $team2Stats['score'], $team2Stats['wickets'], $team2Stats['overs'], $winningTeamId);
        event(new MatchStatsEvent());
    }

    function calculateMatchStats($match)
    {
        $team1Stats = $this->getTeamStats($match->id, $match->team1);
        $team2Stats = $this->getTeamStats($match->id, $match->team2);
        return [$team1Stats, $team2Stats];
    }

    function getTeamStats($matchId, $team)
    {
        $playerIds = array_map(function ($player) {
            return $player['id'];
        }, $team->players->toArray());
        $matchStats = $this->matchHistoryRepository->getByMatchBatsmen($matchId, $playerIds);
        $score = $matchStats->sum('score');
        $balls = $matchStats->whereNotIn('score_type_id', [ScoreName::$NO_BALL_ID, ScoreName::$WIDE_BALL_ID])->count();
        $overs = $this->calculateOvers($balls);
        $wickets = $matchStats->whereIn('score_type_id', [ScoreName::$CATCH_OUT_ID, ScoreName::$RUN_OUT_ID, ScoreName::$OUT_ID])->count();
        return ['id' => $team->id, 'name' => $team->name, 'score' => $score, 'overs' => $overs, 'wickets' => $wickets];
    }

    private function calculateOvers($balls)
    {
        $first = floor($balls / 6);
        $second = fmod($balls, 6) / 10;
        return $first + $second;
    }

    function updateMatch($id, $fields)
    {
        return $this->repository->update($id, $fields);
    }

    function startMatch($matchId)
    {
        $this->addMatchStats($matchId);
        return $this->updateMatch($matchId, ['status' => MatchStatus::$IN_PROGRESS]);
    }

    function finishMatch($matchId)
    {
        $this->updateMatch($matchId, ['status' => MatchStatus::$FINISHED]);
        $this->updateMatchStats($matchId);
    }

    function scheduleMatches () {
        $tournament = $this->tournamentComponent->first();
        $matchTime = Carbon::now();
        $status = MatchStatus::$SCHEDULED;
        $teamIds = array_map(function ($team) {
            return $team['id'];
        }, $tournament->teams->toArray());
        $schedules = TournamentMatchScheduler::schedule($teamIds);
        $matches = [];
        foreach ($schedules as $index => $schedule) {
            $match = [
                'team1_id' => $schedule['team1'],
                'team2_id' => $schedule['team2'],
                'tournament_id' => $tournament->id,
                'match_time' => $matchTime,
                'status' => $status
            ];
            array_push($matches, $match);
        }
        DB::table('matches')->insert($matches);
        event(new MatchStatsEvent());
    }

}