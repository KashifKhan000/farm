<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\{Level};

class LevelSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        /* Create the Level System */

        $level = [
            [
                'level' => '0',
                'badges' => '0',
                'points' => '0',
            ],
            [
                'level' => '1',
                'badges' => '2',
                'points' => '1500',
            ],
            [
                'level' => '2',
                'badges' => '5',
                'points' => '10000',
            ],
            [
                'level' => '3',
                'badges' => '10',
                'points' => '25000',
            ],
            [
                'level' => '4',
                'badges' => '15',
                'points' => '50000',
            ],
            [
                'level' => '5',
                'badges' => '20',
                'points' => '85000',
            ],
            [
                'level' => '6',
                'badges' => '25',
                'points' => '130000',
            ],
            [
                'level' => '7',
                'badges' => '30',
                'points' => '175000',
            ],
            [
                'level' => '8',
                'badges' => '35',
                'points' => '225000',
            ],
            [
                'level' => '9',
                'badges' => '40',
                'points' => '275000',
            ],
            [
                'level' => '10',
                'badges' => '45',
                'points' => '325000',
            ],
            [
                'level' => '11',
                'badges' => '50',
                'points' => '375000',
            ],
            [
                'level' => '12',
                'badges' => '55',
                'points' => '425000',
            ],
            [
                'level' => '13',
                'badges' => '60',
                'points' => '475000',
            ],
            [
                'level' => '14',
                'badges' => '65',
                'points' => '525000',
            ],
            [
                'level' => '15',
                'badges' => '70',
                'points' => '575000',
            ],
            [
                'level' => '16',
                'badges' => '75',
                'points' => '625000',
            ],
            [
                'level' => '17',
                'badges' => '80',
                'points' => '675000',
            ],
            [
                'level' => '18',
                'badges' => '85',
                'points' => '725000',
            ],
            [
                'level' => '19',
                'badges' => '90',
                'points' => '775000',
            ],
            [
                'level' => '20',
                'badges' => '95',
                'points' => '825000',
            ]
        ];

        foreach ($level as $level) {
            Level::firstOrCreate($level);
        }
    }
}
