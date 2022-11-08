<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{User, Account, Secret, Identity, Privilege, Profile, Ability};

class AdminSeeder extends Seeder
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

        $user = User::firstOrCreate([
            'account_id' => Account::create()->id,
            'first_name' => 'Admin',
            'middle_name' => 'M.',
            'last_name' => 'Adminer',
            'is_enabled' => 1,
            'identified_at' => Carbon::now()->toDateTimeString(),
        ]);

       /**
        * Create the user's identity
        */

        Identity::firstOrCreate([
            'user_id' => $user->id,
            'name' => 'primary',
            'type' => 'email',
            'value' => 'admin@fmhero.com',
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

        Secret::firstOrCreate([
            'user_id' => $user->id,
            'type' => 'password',
            'value' => 'password',
        ]);

        /**
         * Make root privilege and attach ability
         */

        $privilege = Privilege::firstOrCreate([
            'name' => 'Root'
        ]);

        Ability::firstOrCreate([
            'privilege_id' => $privilege->id,
            'name' => '*',
            'model_type' => '*',
        ]);

        /**
         * Attach the user to the root
         */

         $user->privileges()->syncWithoutDetaching($privilege->id);
    }
}
