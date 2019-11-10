<?php

use Illuminate\Database\Seeder;

class TruncateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('score_types')->delete();
        \Illuminate\Support\Facades\DB::table('matches')->delete();
        \Illuminate\Support\Facades\DB::table('tournament_team')->delete();
        \Illuminate\Support\Facades\DB::table('tournaments')->delete();
        \Illuminate\Support\Facades\DB::table('player_team')->delete();
        \Illuminate\Support\Facades\DB::table('teams')->delete();
        \Illuminate\Support\Facades\DB::table('players')->delete();
    }
}
