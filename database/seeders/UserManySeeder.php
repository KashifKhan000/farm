<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserManySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->call([ UserSeeder::class ]);
        }
    }
}
