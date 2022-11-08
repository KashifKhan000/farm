<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{BadgeCategory};

class BadgeCategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /**
         * Create the Badge Categories
         */

        $badgeCategories = [
            'App Usage',
            'Asset Data: Coordinates',
            'Asset Data: OCR Usage',
            'Asset Data: Photo',
            'Cylinder Transfer',
            'Service Event: Asset',
            'Service Event: Completed',
            'Share: Accepted Unmodified',
            'Share: Accepted All',
            'Share: Sent',
            'Promoter',
        ];

        foreach ($badgeCategories as $category) {
            BadgeCategory::firstOrCreate(['name' => $category]);
        }
    }
}
