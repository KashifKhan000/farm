<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasOwnership;

class EquipmentAssetOwner extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'owner_id',
        'owner_type',
        'equipment_asset_id',
    ];
}
