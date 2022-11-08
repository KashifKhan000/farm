<?php

namespace App\Listeners\Api\v1\EquipmentAsset;


use App\Events\Api\v1\EquipmentAsset\EquipmentAssetOcrScannned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\Observers\Api\v1\Badges\HasEquipmentAssetBadges;

class CheckEquipmentAssetOcrScan
{
    use HasEquipmentAssetBadges;

    public $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Add an amount to the user's current OCR scans and handle the badge events
     *
     * @param  EquipmentAssetOcrScannned  $event
     * @return void
     */
    public function handle(EquipmentAssetOcrScannned $event)
    {
        $ocr_scans =  $this->user->meta()->firstOrCreate(['name' => 'ocr_scans'])->integers()->firstOrNew();
        $ocr_scans->value += 1;
        $ocr_scans->save();
        $this->handleBadges($event->equipment_asset);
    }
}
