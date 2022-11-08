<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasTransfer extends Model
{

    protected $fillable = [
        'owner_id',
        'owner_type',
        'recovery_equipment_id'
    ];

    protected $with = [
        'gas_recoveries_from',
        'gas_recoveries_to',
        'gas_charges'
    ];

    protected $appends = [
        'total_gas_recovered_from',
        'total_gas_recovered_to',
    ];

    protected $hidden = [
        'owner',
        'gas_movements'
    ];

    /**
     * Retrieve the owner of this resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_movements()
    {
        return $this->hasMany(GasMovement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_charges()
    {
        return $this->hasMany(GasMovement::class)
            ->whereNotNull('from_cylinder_asset_id')
            ->whereNotNull('to_equipment_asset_circuit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_recoveries_from()
    {
        return $this->hasMany(GasMovement::class)
            ->whereNotNull('from_equipment_asset_circuit_id')
            ->orWhereNotNull('from_cylinder_asset_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_recoveries_to()
    {
        return $this->hasMany(GasMovement::class)
            ->whereNotNull('to_equipment_asset_circuit_id')
            ->orWhereNotNull('to_cylinder_asset_id');
    }

    public function getTotalGasRecoveredFromAttribute()
    {
        return $this->gas_recoveries_from()->where('gas_transfer_id', $this->id)->sum('gas_quantity');
    }


    public function getTotalGasRecoveredToAttribute()
    {
        return $this->gas_recoveries_to()->where('gas_transfer_id', $this->id)->sum('gas_quantity');
    }


}
