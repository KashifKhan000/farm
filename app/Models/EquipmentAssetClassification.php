<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentAssetClassification extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipment_assets()
    {
        return $this->hasMany(EquipmentAsset::class);
    }
}
