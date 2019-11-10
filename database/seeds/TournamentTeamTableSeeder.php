<?php

use Illuminate\Database\Seeder;

class TournamentTeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournament = \Illuminate\Support\Facades\DB::table('tournaments')->first();
        $teams = \Illuminate\Support\Facades\DB::table('teams')->get();
        $tournament_team = [];
        foreach ($teams as $team) {
            array_push($tournament_team, ['tournament_id' => $tournament->id, 'team_id' => $team->id]);
        }
        \Illuminate\Support\Facades\DB::table('tournament_team')->insert($tournament_team);
    }
}
