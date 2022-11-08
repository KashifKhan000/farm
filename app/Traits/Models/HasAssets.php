<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;
use App\Models\{EquipmentAsset,CylinderAsset};

trait HasAssets
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function equipment_assets()
    {
        return $this->morphToMany(
            EquipmentAsset::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function cylinder_assets()
    {
        return $this->morphToMany(
            CylinderAsset::class,
            'owner',
            'cylinder_asset_owners',
        );
    }
}
