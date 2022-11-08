<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\{Point, User};

class UserPointSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::first();
        for ($i = 1; $i <= 300; $i++) {

            $point = Point::inRandomOrder()->first()->id;
            $user->points()->attach($point);
        }
    }
}
