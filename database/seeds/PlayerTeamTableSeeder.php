<?php

use Illuminate\Database\Seeder;

class PlayerTeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = \Illuminate\Support\Facades\DB::table('teams')->get();
        $playersPerTeam = 6;
        $currentIndex = 0;
        $player_team = [];
        foreach ($teams as $team) {
            $players = \Illuminate\Support\Facades\DB::table('players')->skip($currentIndex)->take($playersPerTeam)->get('id');
            foreach ($players as $player) {
                array_push($player_team, ['player_id' => $player->id, 'team_id' => $team->id]);
            }
            $currentIndex = $currentIndex + $playersPerTeam;
        }
        \Illuminate\Support\Facades\DB::table('player_team')->insert($player_team);
    }
}
