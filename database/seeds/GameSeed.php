<?php

use Illuminate\Database\Seeder;

class GameSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'team1_id' => 1,
                'team2_id' => 3,
                'start_time' => '2021-07-25',
                'result1' => 3,
                'result2' => 0,
                'type_match'=>'home match',
            ],
            [
                'id' => 2,
                'team1_id' => 1,
                'team2_id' => 2,
                'start_time' => '2021-08-01',
                'result1' => 3,
                'result2' => 1,
                'type_match'=>'home match',
            ],
            [
                'id' => 3,
                'team1_id' => 1,
                'team2_id' => 4,
                'start_time' => '2021-08-25',
                'result1' => null,
                'result2' =>null ,
                'type_match'=>'home match',
            ],


        ];

        foreach ($items as $item) {
            \App\Game::create($item);
        }
    }
}
