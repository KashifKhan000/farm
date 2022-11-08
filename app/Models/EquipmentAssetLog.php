<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentAssetLog extends Model
{
    protected $fillable = [
        'equipment_asset_id',
        'type',
        'notes',
    ];
}
