<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{Company, User};

class CompanySeeder extends Seeder
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
                'user_id' => User::inRandomOrder()->first()->id
            ];

            $company = Company::create($fields)->fresh();

            $address = [
                'name' => 'primary',
                'line1' => $faker->secondaryAddress(),
                'line2' => $faker->secondaryAddress(),
                'province' => $faker->stateAbbr(),
                'city' => $faker->city(),
                'postal_code' => $faker->postcode(),
                'country' => 'USA',
                'lng' => $faker->latitude(-101.18982, -96.30478),
                'lat' => $faker->longitude(38.72343, 43.71900),
            ];

            $company->createAddress($address);
        }
    }
}
