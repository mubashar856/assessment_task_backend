<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TruncateTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(PlayerTeamTableSeeder::class);
        $this->call(TournamentsTableSeeder::class);
        $this->call(TournamentTeamTableSeeder::class);
        $this->call(MatchesTableSeeder::class);
        $this->call(ScoreTypesTableSeeder::class);
    }
}
