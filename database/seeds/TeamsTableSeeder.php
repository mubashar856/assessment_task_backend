<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [];
        for ($i = 1; $i <= 6; $i++) {
            array_push($teams, ['id' => $i, 'name' => \Illuminate\Support\Str::random(10)]);
        }
        \Illuminate\Support\Facades\DB::table('teams')->insert($teams);
    }
}
