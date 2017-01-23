<?php

use Illuminate\Database\Seeder;
use App\Team;
use App\Member;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name' => 'Build Team',
            'children' => [
                [
                    'name' => 'S1',
                    'children' => [
                        [
                            'name' => 'S2'
                        ],
                        [
                            'name' => 'CTV'
                        ]
                    ]
                ],
                [
                    'name' => 'Core Team',
                ]
            ]
        ]);


    }
}
