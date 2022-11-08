<?php

namespace Database\Seeders;

use App\Models\EquipmentAsset;
use App\Models\ServiceEvent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            DefaultUserSeeder::class,
            EquipmentAssetManufacturerSeeder::class,
            EquipmentAssetClassificationSeeder::class,
            CylinderAssetManufacturerSeeder::class,
            SiteSeeder::class,
            GasSeeder::class,
            UserSeeder::class,
            BadgeCategorySeeder::class,
            BadgeSeeder::class,
            LevelSeeder::class,
            PointSeeder::class,
            GoalSeeder::class,
            EquipmentAssetSeeder::class,
            ServiceEventSeeder::class,
        ]);
    }
}
