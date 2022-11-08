<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class SiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 1; $i <= 50; $i++) {
            $fields = [
                'name' => $faker->company(),
            ];

            $site = Site::create($fields)->fresh();


            /**
             * All addresses located in Florida
             */
            $address = [
                'name' => 'primary',
                'line1' => $faker->secondaryAddress(),
                'line2' => $faker->secondaryAddress(),
                'province' => "FL",
                'city' => $faker->city(),
                'postal_code' => $faker->postcode(),
                'country' => 'USA',
                'lng' => $faker->latitude(-101.18982, -96.30478),
                'lat' => $faker->longitude(38.72343, 43.71900),
            ];

            $site->createAddress($address);
        }
    }
}
