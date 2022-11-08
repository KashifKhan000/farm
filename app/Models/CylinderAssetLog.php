<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CylinderAssetLog extends Model
{
    protected $fillable = [
        'cylinder_asset_id',
        'type',
        'notes',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function cylinder_assets()
    {
        return $this->hasOne(CylinderAsset::class);
    }
}
