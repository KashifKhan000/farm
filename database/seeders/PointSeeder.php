<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\{Point, BadgeCategory};

class PointSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        /* Create the Point System */
        $points = [
            [
                'badge_category_id' => BadgeCategory::where('name', 'App Usage')->firstOrCreate()->id,
                'name' => 'Open App',
                'description' => 'Every open. Available once a day',
                'method' => 'Open Count',
                'quantity' => 1
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'App Usage')->firstOrCreate()->id,
                'name' => 'Asset Added',
                'description' => 'Every asset added to the database',
                'method' => 'Asset Addition Count',
                'quantity' => 5
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Service Event: Completed')->firstOrCreate()->id,
                'name' => 'Se Done',
                'description' => 'Every completed Service Event',
                'method' => 'SE Complete Count',
                'quantity' => 1
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Service Event: Asset')->firstOrCreate()->id,
                'name' => 'Assets Serviced',
                'description' => 'Every asset added to an SE',
                'method' => 'Asset SE Count',
                'quantity' => 1
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Cylinder Transfer')->firstOrCreate()->id,
                'name' => 'Cylinder Sender',
                'description' => 'Every sent cylinder to another FMH',
                'method' => 'Cylinder Send Transaction Count',
                'quantity' => 2
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Cylinder Transfer')->firstOrCreate()->id,
                'name' => 'Cylinder Receiver',
                'description' => 'Every recieved cylinder to another FMH',
                'method' => 'Cylinder Received Transaction Count',
                'quantity' => 2
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Asset Data: Coordinates')->firstOrCreate()->id,
                'name' => 'Asset Locator',
                'description' => 'Each asset coordinate recorded',
                'method' => 'Asset Coordinate Count',
                'quantity' => 5
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Asset Data: OCR Usage')->firstOrCreate()->id,
                'name' => 'Scan King',
                'description' => 'Each asset nameplate scanned',
                'method' => 'OCR completed Count',
                'quantity' => 5
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Asset Data: Photo')->firstOrCreate()->id,
                'name' => 'Photographer',
                'description' => 'Each asset photo taken',
                'method' => 'Asset Photo Count',
                'quantity' => 10
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Sent')->firstOrCreate()->id,
                'name' => 'Evangelist',
                'description' => 'First time share with someone',
                'method' => 'SE NEW Share Sent Count',
                'quantity' => 20
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Sent')->firstOrCreate()->id,
                'name' => 'Sharer',
                'description' => 'Every SE share sent',
                'method' => 'SE Share Sent Count',
                'quantity' => 5
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Accepted All')->firstOrCreate()->id,
                'name' => 'Recruiter',
                'description' => 'Share results in new paying FMH client',
                'method' => 'New Client via Share',
                'quantity' => 250
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Accepted All')->firstOrCreate()->id,
                'name' => 'Mentor',
                'description' => 'First time receiver accepts a share',
                'method' => 'SE Share NEW Accepted Count',
                'quantity' => 25
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Accepted All')->firstOrCreate()->id,
                'name' => 'Ambassador',
                'description' => 'Every SE accepted by reciever (points to sender)',
                'method' => 'SE Share Accepted Count',
                'quantity' => 5
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Share: Accepted Unmodified')->firstOrCreate()->id,
                'name' => 'Perfectionist',
                'description' => 'Every SE accepted and unmodified (points to sender)',
                'method' => 'SE Share Accepted Unmodified Count',
                'quantity' => 10
            ],
            [
                'badge_category_id' => BadgeCategory::where('name', 'Promoter')->firstOrCreate()->id,
                'name' => 'Socializer',
                'description' => 'Promoting APP on EACH Social Media Site (twitter, FB, Linked, etc) -ONE TIME EA',
                'method' => 'Positive (Stock) Social Media Post Count',
                'quantity' => 25
            ]
        ];

        foreach ($points as $point) {
            Point::firstOrCreate($point);
        }
    }
}
