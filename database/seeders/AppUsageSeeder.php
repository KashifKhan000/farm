<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class AppUsageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {


        for ($i = 1; $i <= 366; $i++) {

            $day  = $i-1;
            DB::table('app_usages')->insert([
                'user_id' => 1,
                'created_at' => DB::raw("DATE_ADD(CURDATE(), INTERVAL -$day DAY)")
            ]);
        }
    }
}
