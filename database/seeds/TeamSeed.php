<?php

use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'name' => 'Real madrid',],
            ['id' => 2, 'name' => 'Barcelona',],
            ['id' => 3, 'name' => 'Atletico Madrid',],
            ['id' => 4, 'name' => 'valencia',],

        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}
