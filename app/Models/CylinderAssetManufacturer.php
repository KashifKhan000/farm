<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CylinderAssetManufacturer extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cylinder_assets()
    {
        return $this->hasOne(CylinderAsset::class);
    }
}
