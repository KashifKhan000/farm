<?php

namespace Database\Seeders;

use App\Models\{ServiceEvent, ServiceEventInstall, ServiceEventScrap, ServiceEventRepair, ServiceEventLeakInspection, ServiceEventShutdownMothball, User, Site, EquipmentAsset, Gas};
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ServiceEventSeeder extends Seeder
{
    /**
     *
     * @param Faker $faker
     * @return ServiceEvent
     */
    protected function createServiceEvent(Faker $faker)
    {
        $fields = [
            'user_id' => User::find(2)->id,
            'site_id' => Site::inRandomOrder()->first()->id,
            'work_order_number' => $faker->ean8(),
            'purchase_order_number' => $faker->ean8(),
            'external_reference_number' => $faker->ean8(),
            'event_description' => $faker->paragraph(),
            'status' => $faker->randomElement(['Upcoming', 'In Progress', 'Completed']),
            'start_at' => Carbon::now()->subDays(random_int(1, 15))->toDateTimeString(),
            'end_at' => ($faker->numberBetween(1, 2) === 1) ? Carbon::now()->subDays(random_int(1, 15))->toDateTimeString() : null,
        ];

        return ServiceEvent::firstOrCreate($fields)->fresh();
    }

    /**
     *
     * @param ServiceEvent $serviceEvent
     * @param Faker $faker
     * @return ServiceEventInstall
     */
    protected function createServiceEventInstall(ServiceEvent $serviceEvent, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => EquipmentAsset::inRandomOrder()->first()->id,
            'service_event_id' => $serviceEvent->id,
            'gas_id' => Gas::inRandomOrder()->first()->id,
            'type' => $faker->randomElement(['Install', 'Re-Install', 'Retrofit']),
            'parts_required' => $faker->sentence(6),
            'actions' => $faker->randomElement(['Bypass', 'Calibrate/Adjust', 'new Cap/Seal', 'Relocate', 'Remove', 'Repair', 'Replace', 'Tighten', 'Weld', 'Other']),
            'notes' => $faker->sentence(6),
            'new_oil_type' => $faker->randomElement(['AB', 'POE', 'Mineral']),
            'new_factory_field_charge' => $faker->numberBetween($min = 1000, $max = 9000),
        ];

        return ServiceEventInstall::firstOrCreate($fields)->fresh();
    }

    /**
     *
     * @param ServiceEvent $serviceEvent
     * @param Faker $faker
     * @return ServiceEventScrap
     */
    protected function createServiceEventScrap(ServiceEvent $serviceEvent, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => EquipmentAsset::inRandomOrder()->first()->id,
            'service_event_id' => $serviceEvent->id,
            'type' => $faker->randomElement(['Remove', 'Replace', 'Other']),
            'is_flat' => $faker->boolean(),
            'notes' => $faker->sentence(6),
        ];

        return ServiceEventScrap::firstOrCreate($fields)->fresh();
    }

    /**
     *
     * @param ServiceEvent $serviceEvent
     * @param Faker $faker
     * @return ServiceEventRepair
     */
    protected function createServiceEventRepair(ServiceEvent $serviceEvent, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => EquipmentAsset::inRandomOrder()->first()->id,
            'service_event_id' => $serviceEvent->id,
            'type' => $faker->randomElement(['Service', 'Leak Repair']),
            'actions' => $faker->randomElement(['Bypass', 'Calibrate/Adjust', 'new Cap/Seal', 'Relocate', 'Remove', 'Repair', 'Replace', 'Tighten', 'Weld', 'Other']),
            'verification_method' => $faker->randomElement(['ALDS', 'Alternative', 'Bubble', 'Dye', 'Electronic', 'Evacuation', 'Halide', 'Pressure']),
            'parts_required' => $faker->sentence(6),
            'notes' => $faker->sentence(6),
        ];

        return ServiceEventRepair::firstOrCreate($fields)->fresh();
    }

    /**
     *
     * @param ServiceEvent $serviceEvent
     * @param Faker $faker
     * @return ServiceEventLeakInspection
     */
    protected function createServiceEventLeakInspection(ServiceEvent $serviceEvent, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => EquipmentAsset::inRandomOrder()->first()->id,
            'service_event_id' => $serviceEvent->id,
            // 'parts_required' => $faker->sentence(6),
            'actions' => $faker->randomElement(['Bypass', 'Calibrate/Adjust', 'new Cap/Seal', 'Relocate', 'Remove', 'Repair', 'Replace', 'Tighten', 'Weld', 'Other']),
            'detection_method' => $faker->randomElement(['Alternative', 'Bubble', 'Dye', 'Electronic Ultrasonic', 'Evacuate', 'Pressure Test', 'Halide']),
            'alds_used' => 1,
            'alds_type' => $faker->randomElement(['Direct', 'Indirect']),
            'inspection_at' => Carbon::now()->subDays(random_int(1, 15))->toDateTimeString(),
            'leak_found' => 1,
            'leak_cause' =>$faker->randomElement(['Rub Out','Joint Failure','Corrosion','Vibration','Abuse','Warranty','Seal Failure','Rupture','Catastrophe','Mechanical Failure','ALDS']),
            'leak_corrective_action' => $faker->randomElement(['Notify Engineering' ,'Scheduled Repair' ,'Removed From Service' ,'Planned Retrofit' ,'Waiting On Parts']),
            'notes' => $faker->sentence(6),
        ];

        return ServiceEventLeakInspection::firstOrCreate($fields)->fresh();
    }

    /**
     *
     * @param ServiceEvent $serviceEvent
     * @param Faker $faker
     * @return ServiceEventLeakInspection
     */
    protected function createServiceEventShutdownMothball(ServiceEvent $serviceEvent, Faker $faker)
    {
        $fields = [
            'equipment_asset_id' => EquipmentAsset::inRandomOrder()->first()->id,
            'service_event_id' => $serviceEvent->id,
            'type' => $faker->randomElement(['Shutdown', 'Mothball']),
            'parts_required' => $faker->sentence(6),
            'actions' => $faker->randomElement(['Other', 'Bypass', 'Relocate', 'Remove', 'Repair', 'Replace']),
        ];

        return ServiceEventShutdownMothball::firstOrCreate($fields)->fresh();
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 1; $i <= 20; $i++) {
            $serviceEvent = $this->createServiceEvent($faker);

            $serviceEventInstall = $this->createServiceEventInstall($serviceEvent, $faker);
            $serviceEventScrap = $this->createServiceEventScrap($serviceEvent, $faker);
            $serviceEventRepair = $this->createServiceEventRepair($serviceEvent, $faker);
            $serviceEventLeakInspection = $this->createServiceEventLeakInspection($serviceEvent, $faker);
            $serviceEventShutdownMothball = $this->createServiceEventShutdownMothball($serviceEvent, $faker);

            for ($j=0; $j < 3; $j++) {
                $equipmentAsset = EquipmentAsset::inRandomOrder()->first();

                $equipmentAsset->service_events()->syncWithoutDetaching($serviceEvent);
                $equipmentAsset->service_event_installs()->syncWithoutDetaching($serviceEventInstall);
                $equipmentAsset->service_event_scraps()->syncWithoutDetaching($serviceEventScrap);
                $equipmentAsset->service_event_repairs()->syncWithoutDetaching($serviceEventRepair);
                $equipmentAsset->service_event_leak_inspections()->syncWithoutDetaching($serviceEventLeakInspection);
                $equipmentAsset->service_event_shutdown_mothballs()->syncWithoutDetaching($serviceEventShutdownMothball);
            }

        }
    }
}
