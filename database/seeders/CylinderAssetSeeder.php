<?php

namespace Database\Seeders;

use App\Models\{CylinderAsset, CylinderAssetManufacturer, User};
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Traits\Controllers\Api\v1\HasAssetFields;

use App\Models\Gas;

class CylinderAssetSeeder extends Seeder
{

    use HasAssetFields;

    private function createCylinderAsset(Faker $faker, $user = null)
    {
        $size = $faker->numberBetween(100, 3545);
        $data = [
            'user_id' => !empty($user) ? $user->id : null,
            'cylinder_size' => $size,
            'serial_number' =>  $faker->ean8(),
            'tag_number' =>  $faker->ean8(),
            'type' => $faker->randomElement(['Disposable','Refillable','Recovery']),
            'purity_label' => '100',
            'manufactured_at' => Carbon::now()->subYears(random_int(1, 15))->toDateTimeString(),
            "manufacturer" => CylinderAssetManufacturer::inRandomOrder()->first()->name,
            'last_recertification_at' => Carbon::now()->subYears(random_int(1, 15))->toDateTimeString(),
            'next_recertification_at' => Carbon::now()->addYears(random_int(1, 15))->toDateTimeString(),
            'tare_weight' => $faker->numberBetween(10, 100),
            'current_gas_weight' => $faker->numberBetween(100, $size)
        ];

        return CylinderAsset::create($data);
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $user = User::find(2);

        for ($i = 0; $i <= 100; $i++) {
            $this->createCylinderAsset($faker, $user);
        }
    }
}
