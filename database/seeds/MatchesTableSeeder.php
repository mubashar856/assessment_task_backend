<?php

use Illuminate\Database\Seeder;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matchComp = new \App\Components\MatchComponent();
        $matchComp->scheduleMatches();
    }
}
