<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\Gas;

class GasSeeder extends Seeder
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

        $gases = [
            'Ammonia',
            'Dynalene HC',
            'EP-88',
            'Ethylene glycol',
            'Isceon MO89',
            'MO-99',
            'PFC-116',
            'PFC-218',
            'Potassium formate - Pekasol',
            'Propylene glycol',
            'R-11',
            'R-111',
            'R-112',
            'R-113',
            'R-114',
            'R-115',
            'R-116',
            'R-12',
            'R-121',
            'R-122',
            'R-123',
            'R-124',
            'R-125',
            'R-1270',
            'R-13',
            'R-134a',
            'R-13b1',
            'R-141b',
            'R-142b',
            'R-143a',
            'R-152a',
            'R-161',
            'R-218',
            'R-22',
            'R-225ca',
            'R-225cb',
            'R-227ea',
            'R-23',
            'R-236fa',
            'R-245fa',
            'R-290',
            'R-32',
            'R-365mfc',
            'R-401',
            'R-401A',
            'R-401B',
            'R-402',
            'R-402B',
            'R-403B',
            'R-404A',
            'R-406A',
            'R-407',
            'R-407A',
            'R-407B',
            'R-407C',
            'R-407D',
            'R-407F',
            'R-408',
            'R-408a',
            'R-409',
            'R-409A',
            'R-410',
            'R-410A',
            'R-413A',
            'R-414',
            'R-414A',
            'R-414B',
            'R-416',
            'R-416A',
            'R-417',
            'R-417A',
            'R-420',
            'R-421',
            'R-421A',
            'R-422',
            'R-422A',
            'R-422B',
            'R-422C',
            'R-422D',
            'R-423A',
            'R-427A',
            'R-43-10mee',
            'R-437A',
            'R-438A',
            'R-441a',
            'R-448A',
            'R-449A',
            'R-449B',
            'R-450A',
            'R-452A',
            'R-452B',
            'R-454B',
            'R-466',
            'R-500',
            'R-502',
            'R-503',
            'R-507',
            'R-508',
            'R-508B',
            'R-513A',
            'R-515B',
            'R-600',
            'R-600a',
            'R-601',
            'R-717',
            'R-744',
            'SF6',
        ];

        foreach ($gases as $gas) {
            Gas::firstOrCreate(['name' => $gas]);
        }
    }
}
