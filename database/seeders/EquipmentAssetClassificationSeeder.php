<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\EquipmentAssetClassification;

class EquipmentAssetClassificationSeeder extends Seeder
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

        $classifications = [
            'Air Cooled',
            'Air Curtain',
            'Air Dryer / Dehumidifier',
            'Air Handling Unit',
            'Blow-Through',
            'Chiller',
            'Continuous',
            'Data Center Cooling',
            'Direct Inline Heating',
            'Direct Side Arm Heating',
            'Draw-Through',
            'Evaporative',
            'EWC/Multizone Split (Ductless)',
            'Fan Assisted Natural Draft',
            'Field Erected',
            'Fire Tube',
            'Food Prep Area',
            'Forced Draft',
            'Heat Pump',
            'Ice Machine',
            'Indirect Heating',
            'Induced Draft',
            'Low Temp',
            'Medical Freezer',
            'Medium Temp',
            'Other',
            'Package Type',
            'Paint',
            'Portable',
            'Reach In',
            'Reach In - Horizontal',
            'Reach In - Vertical',
            'Refrigerator',
            'Roof Top Unit (RTU)',
            'SF6 Bottle',
            'Shower',
            'Sink',
            'Split System',
            'Standalone Freezer',
            'Standby',
            'Toilet',
            'Vacuum',
            'Walk In',
            'Walk In Freezer',
            'Water Cooled',
            'Water Tube',
        ];

        foreach ($classifications as $classification) {
            EquipmentAssetClassification::firstOrCreate(['name' => $classification]);
        }
    }
}
