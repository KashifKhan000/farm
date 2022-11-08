<?php

namespace App\Traits\Models;

use App\Traits\Models\{HasImages, HasVideos};

use App\Models\{EquipmentAsset, GasTransfer, ServiceEvent};

trait IsServiceEventDetail
{
    use HasImages, HasVideos;

    /**
     * Get the service event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_event()
    {
        return $this->belongsTo(ServiceEvent::class);
    }

    public function gas_transfer()
    {
        return $this->morphOne(GasTransfer::class, 'owner');
    }

    public function equipment_asset()
    {
        return $this->belongsTo(EquipmentAsset::class);
    }



    // public function gas_movement_from_equipment_assets()
    // {
    //     return $this->morphMany(GasMovement::class, 'owner')->whereNotNull('from_equipment_asset_id');
    // }

    // public function gas_movement_to_equipment_assets()
    // {
    //     return $this->morphMany(GasMovement::class, 'owner')->whereNotNull('to_equipment_asset_id');
    // }

    // public function gas_movement_from_cylinder_assets()
    // {
    //     return $this->morphMany(GasMovement::class, 'owner')->whereNotNull('from_cylinder_asset_id');
    // }

    // public function gas_movement_to_cylinder_assets()
    // {
    //     return $this->morphMany(GasMovement::class, 'owner')->whereNotNull('to_cylinder_asset_id');
    // }
}
