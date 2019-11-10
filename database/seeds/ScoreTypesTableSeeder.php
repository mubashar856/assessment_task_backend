<?php

use Illuminate\Database\Seeder;

class ScoreTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scoreTypes = [
            ['id' => 1, 'name' => '0', 'score' => 0, 'auto_score' => true],
            ['id' => 2, 'name' => '4', 'score' => 4, 'auto_score' => true],
            ['id' => 3, 'name' => '6', 'score' => 6, 'auto_score' => true],
            ['id' => 4, 'name' => 'out', 'score' => 0, 'auto_score' => true],
            ['id' => 5, 'name' => 'run out', 'score' => 0, 'auto_score' => true],
            ['id' => 6, 'name' => 'catch out', 'score' => 0, 'auto_score' => true],
            ['id' => 7, 'name' => 'wide ball', 'score' => 1, 'auto_score' => true],
            ['id' => 8, 'name' => 'No Ball', 'score' => 1, 'auto_score' => true],
            ['id' => 9, 'name' => 'Running', 'score' => 0, 'auto_score' => false]
        ];
        \Illuminate\Support\Facades\DB::table('score_types')->insert($scoreTypes);
    }
}
