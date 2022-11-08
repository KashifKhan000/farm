<?php

namespace Database\Seeders;

use App\Models\{EquipmentAsset, EquipmentAssetManufacturer, EquipmentAssetClassification,EquipmentAssetCircuit, EquipmentAssetLog, Gas};
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class EquipmentAssetSeeder extends Seeder
{

    /**
     *
     * @param EquipmentAsset $equipmentAsset
     * @param Faker $faker
     * @return EquipmentAssetCircuit
     */
    protected function createCircuit(EquipmentAsset $equipmentAsset, Faker $faker, int $circuitType)
    {
        $type = ( $circuitType === 1) ? 'Primary' : 'Secondary';

        $fields = [
            'equipment_asset_id' => $equipmentAsset->id,
            'name' => ($type === 'Primary') ? 'Primary' : $faker->word(),
            'type' => $type,
            'charge' => $faker->numberBetween(100, 3545),
            'notes' => $faker->realText(50),
        ];

        $circuit = EquipmentAssetCircuit::firstOrCreate($fields);

        $purity = $faker->numberBetween(1, 3);



        for ($j = 1; $j <= $purity; $j++) {
            $circuit->gases()->create([
                'gas_id' => Gas::inRandomOrder()->first()->id,
                'purity' => (int)(100 / $purity),
            ]);
        }


        return $circuit->fresh();
    }

    /**
     *
     * @param EquipmentAsset $equipmentAsset
     * @param Faker $faker
     * @return EquipmentAssetCircuit
     */
    protected function createLog(EquipmentAsset $equipmentAsset, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => $equipmentAsset->id,
            'type' => $faker->randomElement([
                'Repair',
                'Shutdown/Mothball',
                'Install',
                'Scrap',
                'Inspection',
            ]),
            'notes' => $faker->realText(50),
        ];

        return EquipmentAssetLog::firstOrCreate($fields);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

         $operationalStatuses = [
            'Disposed/Destroyed',
            'Mothballed',
            'Normal Operation',
            'Pending Repair All Gas Removed',
            'Planned Retirement',
            'Planned Retrofit',
            'Interim Non-Operation',
            'Seasonal Non-Operation',
            'Seasonal Operation',
            'Shutdown',
            'Sold',
            'Under Repair',
         ];

         $regulatoryClasses = [
            'Comfort Cooling',
            'Industrial Process Cooling',
            'Other',
            'Refrigeration',
         ];

         $oilTypes = [
            'AB',
            'POE',
            'Mineral'
         ];

         $chargeCalculationMethods = [
            'Default',
            'Other',
         ];

         $equipmentAssetOwners = [
             'Site',
             'ServiceEventInstall',
             'ServiceEventLeakInspection',
             'ServiceEventRepair',
             'ServiceEventShutdownMothball',
         ];

        for ($i = 1; $i <= 50; $i++) {
            $data = [
                'name' => $faker->bs(),
                'alias' => $faker->bs(),
                'equipment_classification_id' => EquipmentAssetClassification::inRandomOrder()->first()->id,
                'manufacturer' => EquipmentAssetManufacturer::inRandomOrder()->first()->name,
                // 'gas_id' => Gas::inRandomOrder()->first()->id,
                'operational_status' => $operationalStatuses[array_rand($operationalStatuses)],
                'regulatory_class' => $regulatoryClasses[array_rand($regulatoryClasses)],
                'oil_type' => $oilTypes[array_rand($oilTypes)],
                'classification_other' => $faker->realText(20),
                'model' => $faker->ean13(),
                'model_year' => $faker->year(),
                'serial' => $faker->ean8(),
                'manufactured_at' => Carbon::now()->subYears(random_int(1, 15))->toDateTimeString(),
                'acquired_at' => Carbon::now()->subMonths(random_int(1, 28))->addSeconds(random_int(0, 86400))->toDateTimeString(),
                'lng' => $faker->longitude(),
                'lat' => $faker->latitude(),
                'notes' => $faker->realText(100),
                'shutdown_at' => Carbon::now()->subDays(random_int(1, 15))->toDateTimeString(),
            ];

            $equipmentAsset = EquipmentAsset::firstOrCreate($data);

            $owner = $equipmentAssetOwners[array_rand($equipmentAssetOwners)];

            /**Create 1-3 circuits */
            for ($j = 1; $j <= $faker->numberBetween(1,3); $j++) {
                $this->createCircuit($equipmentAsset, $faker, $j);
            }

            /**Create 1-5 logs */
            for ($j = 1; $j <= $faker->numberBetween(1,5); $j++) {
                $this->createLog($equipmentAsset, $faker);
            }
        }
    }
}
