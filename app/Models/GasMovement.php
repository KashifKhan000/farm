<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\HasOwnership;
use Illuminate\Support\Facades\Log;

class GasMovement extends Model
{
    use HasOwnership;

    protected $fillable = [
        'gas_transfer_id',
        'to_cylinder_asset_id',
        'from_cylinder_asset_id',
        'to_equipment_asset_circuit_id',
        'from_equipment_asset_circuit_id',
        'gas_quantity',
        'vacuum_pulled',
        'vacuum_pulled_unit',
        'notes',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gas_transfer()
    {
        return $this->belongsTo(GasTransfer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from_cylinder_asset()
    {
        return $this->belongsTo(CylinderAsset::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function to_cylinder_asset()
    {
        return $this->belongsTo(CylinderAsset::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function to_equipment_asset_circuit()
    {
        return $this->belongsTo(EquipmentAssetCircuit::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from_equipment_asset_circuit()
    {
        return $this->belongsTo(EquipmentAssetCircuit::class);
    }

    static public function boot()
    {
        parent::boot();
        self::created(function (GasMovement $gas_movement) {
            Log::info($gas_movement);
        });
    }
}
