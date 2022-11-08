<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{User, Account, Company, Secret, Identity, Profile};

class DefaultUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Create the default admin user
         */

        $user = User::create([
            'account_id' => Account::create()->id,
            'first_name' => 'User',
            'middle_name' => 'U.',
            'last_name' => 'User',
            'is_enabled' => 1,
            'identified_at' => Carbon::now()->toDateTimeString(),
        ]);

       /**
        * Create the user's identity
        */

        Identity::create([
            'user_id' => $user->id,
            'name' => 'primary',
            'type' => 'email',
            'value' => 'user@fmhero.com',
            'verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        Profile::firstOrCreate([
            'owner_type' => 'User',
            'owner_id' => $user->id,
            'name' => 'primary',
        ]);

        /**
         * Create the user's secret
         */

        Secret::create([
            'user_id' => $user->id,
            'type' => 'password',
            'value' => 'password',
        ]);


        $company = Company::firstOrCreate([
            'name' => $faker->company(),
            'user_id' => $user->id
        ]);

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
