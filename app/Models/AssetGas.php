<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\Models\HasOwnership;

class AssetGas extends Pivot
{
    use HasOwnership;

    protected $table = 'asset_gas';

    protected $fillable = [
        'owner_id',
        'owner_type',
        'gas_id',
        'purity'
    ];

    protected $appends = [
        'gas_charge',
        'gas_name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cylinder_asset()
    {
        return $this->morphTo('cylinder_asset', 'owner_type', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipment_asset_circuit()
    {
        return $this->morphTo('equipment_asset_circuit', 'owner_type', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gas_transfer()
    {
        return $this->morphTo('gas_transfer', 'owner_type', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gas()
    {
        return $this->belongsTo(Gas::class);
    }

    public function getGasChargeAttribute()
    {
        return number_format($this->owner()->first()->charge * ($this->purity /100 ));
    }


    public function getGasNameAttribute()
    {
        return $this->gas->name;
    }


}
