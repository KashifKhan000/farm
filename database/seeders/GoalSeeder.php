<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\{User, Goal, GoalCategory};
use Faker\Generator as Faker;

use App\Models\Gas;

class GoalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Create the goal categories
         */

        $goalCategories = [
            'Customer Service',
            'Customer Service Events',
            'Improved Accuracy',
            'No Hero Left Behind (Helping a coworker)',
            'Above and Beyond',
        ];

        $days = [
            'Sun' => 1,
            'Mon' => 2,
            'Tue' => 4,
            'Wed' => 8,
            'Thu' => 16,
            'Fri' => 32,
            'Sat' => 64
        ];

        $daysSelected = $days['Sun'] | $days['Mon'] | $days['Tue'] | $days['Wed'] | $days['Thu'] | $days['Fri'] | $days['Sat'];

        foreach ($goalCategories as $category) {
            GoalCategory::firstOrCreate(['name' => $category]);
        }

        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'user_id' => 2, //This is the default user with base-level privileges
                'goal_category_id' => $faker->numberBetween(1, 5),
                'name' => $faker->catchPhrase(),
                'description' => $faker->realText(100),
                'recap' => $faker->realText(50),
                'status' => $faker->randomElement(['On-Going', 'Completed']),
                'notification_time' => $faker->time('H:i:s', 'now'),
                'notification_days' => $daysSelected,
            ];

            Goal::create($data);
        }
    }
}
