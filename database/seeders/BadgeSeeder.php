<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\{Badge, BadgeCategory};

class BadgeSeeder extends Seeder
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

        $badges = [
            [
                'category' => 'App Usage',
                'name' => "Weekling",
                'description' => "Open the app every day for 7 consecutive days",
                'method' => "Consecutive Day Count",
                'quantity' => "7",
                'caption' => "Weekling or weakling? Bulk up Hero - log in every day to earn more badges! 7 isn't bad - can you do 30?"
            ],
            [
                'category' => 'App Usage',
                'name' => "Enthusiast",
                'description' => "Open the app every day for 30 consecutive days",
                'method' => "Consecutive Day Count",
                'quantity' => "30",
                'caption' => "Heroes never sleep! 30 days straight - Nice work!"
            ],
            [
                'category' => 'App Usage',
                'name' => "Fanatic",
                'description' => "Open the app every day for 100 consecutive days",
                'method' => "Consecutive Day Count",
                'quantity' => "100",
                'caption' => "Fanatic, centurion or just HERO - what title befits 100 days in a row of dedicated service?"
            ],
            [
                'category' => 'App Usage',
                'name' => "Yearling",
                'description' => "Active user for one year with at least 1000 points",
                'method' => "1000 POINTS & 365 DAYS FROM FIRST LOGIN TO MOST RECENT",
                'quantity' => "365",
                'caption' => "You're starting to get your feet under you! You are one year in and still pressing forward!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Penny Club",
                'description' => "First SE completed",
                'method' => "SE Count",
                'quantity' => "1",
                'caption' => "One down! Congrats on your first completed Service Event!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Quarterback",
                'description' => "25 SEs completed",
                'method' => "SE Count",
                'quantity' => "25",
                'caption' => "25 Down - Hit the slots moneymaker!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Benjamin Award",
                'description' => "100 SEs completed",
                'method' => "SE Count",
                'quantity' => "100",
                'caption' => "It's all about the Benjamins BABY! Nice work on knocking out your first 100 Service Events!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Pro Class",
                'description' => "250 SEs completed",
                'method' => "SE Count",
                'quantity' => "250",
                'caption' => "Rack'n 'em UP! 250 Service Events completed!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Seasoned Veteran",
                'description' => "500 SEs completed",
                'method' => "SE Count",
                'quantity' => "500",
                'caption' => "Slay'n 'em! 500 Service Events complete!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "MINI-ME",
                'description' => "SE completed on Asset <2 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "<2",
                'caption' => "Good things come in small packages."
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Sweet Spot",
                'description' => "SE completed on Asset 2-10 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "2-10",
                'caption' => "2-10 lb systems are the bread and butter of the 3.6 billion units in use. Keep hitt'n that sweet spot!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "God Father",
                'description' => "SE completed on Asset 11-50 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "11-50",
                'caption' => "The Don of systems - welcome to 'the family'!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Body Builder",
                'description' => "SE completed on Asset 51-250 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "51-250",
                'caption' => "Look'n tone! Lift a little heavier and you'll bulk up!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Heavy Lifter",
                'description' => "SE completed on Asset 251-1,000 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "251-1,000",
                'caption' => "Have you been working out?! That's a big piece of hardware!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Beast",
                'description' => "SE completed on Asset 1,001-10,000 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => "1,001-10,000",
                'caption' => "Working on the big stuff eh?! What a BEAST!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Leviathon",
                'description' => "SE completed on Asset >10,000 lbs",
                'method' => "Asset Factory/Field Charge",
                'quantity' => ">10,000",
                'caption' => "Monsterous, mysterious and mystical - and so is the equipment you work on!"
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Diversity",
                'description' => "Awarded all 7 SE completed badges",
                'method' => "Badge Monitor",
                'quantity' => "7",
                'caption' => "Is there anything you can't do?! You are a rare breed indeed."
            ],
            [
                'category' => 'Service Event: Completed',
                'name' => "Versitality",
                'description' => "Awarded 4 of the SE completed badges",
                'method' => "Badge Monitor",
                'quantity' => "4",
                'caption' => "Never one to stick to a single sized unit are you? Way to be adaptable!"
            ],
            [
                'category' => 'Service Event: Asset',
                'name' => "Minotaur",
                'description' => "Qty of Assets tied to 1 SE",
                'method' => "Service Event Asset Count",
                'quantity' => "5",
                'caption' => "Five units, one service event. You're no bull!"
            ],
            [
                'category' => 'Service Event: Asset',
                'name' => "Griffin",
                'description' => "Qty of Assets tied to 1 SE",
                'method' => "Service Event Asset Count",
                'quantity' => "20",
                'caption' => "We'd be Lion if we didn't See you takin' on more!"
            ],
            [
                'category' => 'Service Event: Asset',
                'name' => "Centaur",
                'description' => "Qty of Assets tied to 1 SE",
                'method' => "Service Event Asset Count",
                'quantity' => "100",
                'caption' => "You aren't hors'n around - 100 systems on one Service Event!"
            ],
            [
                'category' => 'Service Event: Asset',
                'name' => "Phoenix",
                'description' => "Qty of Assets tied to 1 SE",
                'method' => "Service Event Asset Count",
                'quantity' => "250",
                'caption' => "You're on FIRE - rising from the ashes to take on that many systems at one time!"
            ],
            [
                'category' => 'Asset Data: OCR Usage',
                'name' => "Cyclops",
                'description' => "Cumulative count of Asset OCR scans completed",
                'method' => "Asset OCR Scan Count",
                'quantity' => "1",
                'caption' => "Stay focused - Keep your eye on the prize!"
            ],
            [
                'category' => 'Asset Data: OCR Usage',
                'name' => "Eagle Eye",
                'description' => "Cumulative count of Asset OCR scans completed",
                'method' => "Asset OCR Scan Count",
                'quantity' => "10",
                'caption' => "Can you see your way to the next badge?"
            ],
            [
                'category' => 'Asset Data: OCR Usage',
                'name' => "AWACS",
                'description' => "Cumulative count of Asset OCR scans completed",
                'method' => "Asset OCR Scan Count",
                'quantity' => "100",
                'caption' => "You record everything you see don't you?!"
            ],
            [
                'category' => 'Asset Data: OCR Usage',
                'name' => "Eye or Sauron",
                'description' => "Cumulative count of Asset OCR scans completed",
                'method' => "Asset OCR Scan Count",
                'quantity' => "500",
                'caption' => "The all seeing eye. Does nothing escape your vision? Impressive!"
            ],
            [
                'category' => 'Asset Data: Coordinates',
                'name' => "Orienteer",
                'description' => "Asset coordinate location captured",
                'method' => "Asset specific location coordinates count",
                'quantity' => "1",
                'caption' => "Just getting the hang of that GPS?"
            ],
            [
                'category' => 'Asset Data: Coordinates',
                'name' => "Explorer",
                'description' => "Asset coordinate location captured",
                'method' => "Asset specific location coordinates count",
                'quantity' => "10",
                'caption' => "Soon you'll be mapping out new undiscovered territory."
            ],
            [
                'category' => 'Asset Data: Coordinates',
                'name' => "Cartographer",
                'description' => "Asset coordinate location captured",
                'method' => "Asset specific location coordinates count",
                'quantity' => "100",
                'caption' => "Mapping the way for all those in the future - are you a famous?!"
            ],
            [
                'category' => 'Asset Data: Coordinates',
                'name' => "Magellan",
                'description' => "Asset coordinate location captured",
                'method' => "Asset specific location coordinates count",
                'quantity' => "500",
                'caption' => "Is there anywhere you haven't discovered?! Next you know you'll be naming the oceans!"
            ],
            [
                'category' => 'Asset Data: Photo',
                'name' => "Sketch Artist",
                'description' => "Picture of asset uploaded (not SE photos - Asset only)",
                'method' => "Asset photo upload count",
                'quantity' => "1",
                'caption' => "A picture is worth a thousand words."
            ],
            [
                'category' => 'Asset Data: Photo',
                'name' => "Polaroid",
                'description' => "Picture of asset uploaded (not SE photos - Asset only)",
                'method' => "Asset photo upload count",
                'quantity' => "10",
                'caption' => "A little dated, but a bit more practice and you'll be snapping shots everywhere!"
            ],
            [
                'category' => 'Asset Data: Photo',
                'name' => "Candid",
                'description' => "Picture of asset uploaded (not SE photos - Asset only)",
                'method' => "Asset photo upload count",
                'quantity' => "100",
                'caption' => "Did that unit know you took it's picture? Keep your camera at the ready and catch'n em on the fly!"
            ],
            [
                'category' => 'Asset Data: Photo',
                'name' => "GoPro",
                'description' => "Picture of asset uploaded (not SE photos - Asset only)",
                'method' => "Asset photo upload count",
                'quantity' => "500",
                'caption' => "Do you take that camera everywhere with you?!"
            ],
            [
                'category' => 'Share: Sent',
                'name' => "Sidekick",
                'description' => "Shared SE sent",
                'method' => "SE shares sent count",
                'quantity' => "1",
                'caption' => "POW! Way to go Robin! What would Batman do without you?"
            ],
            [
                'category' => 'Share: Sent',
                'name' => "Wingman",
                'description' => "Shared SE sent",
                'method' => "SE shares sent count",
                'quantity' => "25",
                'caption' => "Mother Goose - Do you have the need for speed? You're data sharing is keeping heroes everywhere in the air!"
            ],
            [
                'category' => 'Share: Sent',
                'name' => "Liason",
                'description' => "Shared SE sent",
                'method' => "SE shares sent count",
                'quantity' => "100",
                'caption' => "Getting information where it needs to go is your speciality!"
            ],
            [
                'category' => 'Share: Sent',
                'name' => "Ambassador",
                'description' => "Shared SE sent",
                'method' => "SE shares sent count",
                'quantity' => "200",
                'caption' => "Sharing just the right info at just the right timel - representing heroes everywhere."
            ],
            [
                'category' => 'Share: Sent',
                'name' => "Aide de Camp",
                'description' => "Shared SE sent",
                'method' => "SE shares sent count",
                'quantity' => "500",
                'caption' => "Right hand man to the General - You always share just the right info at just the right time."
            ],
            [
                'category' => 'Share: Accepted Unmodified',
                'name' => "Data Discipline",
                'description' => "Accepted shares w/o modification",
                'method' => "SE shares accepted w/o modification count (by sender)",
                'quantity' => "1",
                'caption' => "Are you OCD? No detail out of place, Nice!"
            ],
            [
                'category' => 'Share: Accepted Unmodified',
                'name' => "Data Custodian",
                'description' => "Accepted shares w/o modification",
                'method' => "SE shares accepted w/o modification count (by sender)",
                'quantity' => "50",
                'caption' => "Mopping the floor with perfectly clean data!"
            ],
            [
                'category' => 'Share: Accepted Unmodified',
                'name' => "Data Steward",
                'description' => "Accepted shares w/o modification",
                'method' => "SE shares accepted w/o modification count (by sender)",
                'quantity' => "200",
                'caption' => "Keeper of the keys to the castle - no detail is too small or insignificant for you to get right!"
            ],
            [
                'category' => 'Share: Accepted Unmodified',
                'name' => "Data Marshal",
                'description' => "Accepted shares w/o modification",
                'method' => "SE shares accepted w/o modification count (by sender)",
                'quantity' => "500",
                'caption' => "You bring order, consistency and clarity to the chaos of details everywhere."
            ]
        ];

        foreach ($badges as $badge) {
            $data = [
                'badge_category_id' => BadgeCategory::where('name', $badge['category'])->firstOrCreate()->id,
                'name' => $badge['name'],
                'description' => $badge['description'],
                // 'method' => $badge['method'],
                'caption' => $badge['caption'],
                'quantity' => $badge['quantity'],
            ];
            Badge::firstOrCreate($data);
        }
    }
}
