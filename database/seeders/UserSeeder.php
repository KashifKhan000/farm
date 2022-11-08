<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{User, Account, Secret, Identity, Profile, Company, Certification};
use Carbon\Exceptions\UnitException;
use Exception;

class UserSeeder extends Seeder
{
    /**
     * Create the user
     *
     * @param Faker $faker
     * @return User $user
     */
    protected function createUser(Faker $faker) {
        /**
         * Create the user
         */

        $user = User::firstOrCreate([
            'account_id' => Account::create()->id,
            'first_name' => $faker->firstName(),
            'middle_name' => $faker->randomLetter() . '.',
            'last_name' => $faker->lastName(),
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
            'value' => $faker->email(),
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

        return $user;
    }

    /**
     *
     * @param User $user
     * @param Faker $faker
     * @return Company $company
     */
    protected function createCompany(User $user, Faker $faker)
    {
        $fields = [
            'user_id' => $user->id,
            'name' => $faker->company(),
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
        ];

        $company->createAddress($address);

        return $company;
    }

    /**
     *
     * @param User $user
     * @param Faker $faker
     * @return Certification $certification
     */
    protected function createCertification(User $user, Faker $faker)
    {
        $is_expirable = $faker->boolean();

        $fields = [
            'user_id' => $user->id,
            'name' => $faker->company(),
            'type' => $faker->company(),
            'number' => $faker->ean13(),
            'is_expirable' => $is_expirable,
            'is_primary' => $faker->boolean(),
            'expires_at' => ($is_expirable) ? Carbon::now()->addYears(random_int(1, 15))->toDateTimeString() : null,
            'notes' => $faker->realText(100),
        ];

        $certification = Certification::create($fields)->fresh();

        return $certification;
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 1; $i <= 10; $i++) {
            $user = $this->createUser($faker);

            for ($j = 1; $j <= $faker->numberBetween(1, 2); $j++) {
                $this->createCompany($user, $faker);
            }

            for ($j = 1; $j <= $faker->numberBetween(1, 5); $j++) {
                $this->createCertification($user, $faker);
            }
        }
    }
}
