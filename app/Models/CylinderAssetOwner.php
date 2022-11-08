<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class CylinderAssetOwner extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'owner_id',
        'owner_type',
        'cylinder_asset_id',
    ];
}
