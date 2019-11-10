<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [];
        for ($i = 1; $i <= 36; $i++) {
            array_push($players, ['id' => $i, 'name' => \Illuminate\Support\Str::random(10)]);
        }
        \Illuminate\Support\Facades\DB::table('players')->insert($players);
    }
}
