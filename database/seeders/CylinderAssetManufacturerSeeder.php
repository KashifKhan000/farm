<?php

namespace Database\Seeders;

use App\Models\CylinderAssetManufacturer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\Gas;

class CylinderAssetManufacturerSeeder extends Seeder
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

        $manufacturers = [
            'CylinderCO',
            'CylindersRUS',
            'Compu-Global-Hyper-Cylinder-Net',
        ];

        foreach ($manufacturers as $manufacturer) {
            CylinderAssetManufacturer::firstOrCreate(['name' => $manufacturer]);
        }
    }
}
