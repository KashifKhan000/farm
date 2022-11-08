<?php

namespace App\Traits\Observers\Api\v1\Badges;

use App\Models\{Badge, EquipmentAsset};
use Illuminate\Support\Facades\Log;

trait HasEquipmentAssetBadges
{
    /**
     * Name: Cyclops
     * Description: Cumulative count of Asset OCR scans completed = 1
     * @return void
     */
    protected function badgeCyclops(EquipmentAsset $equipment_asset)
    {
        $badge = Badge::whereName('Cyclops')->first();
        $user = auth()->user();

        if ($user->ocr_scans === 1) {
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    /**
     * Name: EagleEye
     * Description: Cumulative count of Asset OCR scans completed = 10
     * @return void
     */
    protected function badgeEagleEye(EquipmentAsset $equipment_asset)
    {
        $badge = Badge::whereName('Eagle Eye')->first();
        $user = auth()->user();

        if ($user->ocr_scans === 10) {
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    /**
     * Name: AWACS
     * Description: Cumulative count of Asset OCR scans completed = 100
     * @return void
     */
    protected function badgeAWACS(EquipmentAsset $equipment_asset)
    {
        $badge = Badge::whereName('AWACS')->first();
        $user = auth()->user();

        if ($user->ocr_scans === 100) {
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }


    /**
     * Name: Eye of Sauron
     * Description: Cumulative count of Asset OCR scans completed = 100
     * @return void
     */
    protected function badgeEyeOfSauron(EquipmentAsset $equipment_asset)
    {
        $badge = Badge::whereName('Eye of Sauron')->first();
        $user = auth()->user();

        if ($user->ocr_scans === 100) {
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    protected function handleBadges(EquipmentAsset $equipment_asset)
    {
        $this->badgeCyclops($equipment_asset);
        $this->badgeEagleEye($equipment_asset);
        $this->badgeAWACS($equipment_asset);
        $this->badgeEyeOfSauron($equipment_asset);
    }
}
