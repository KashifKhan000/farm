<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CylinderAsset extends Model
{
    protected $fillable = [
        'user_id',
        'cylinder_size',
        'serial_number',
        'tag_number',
        'type',
        'purity_label',
        'manufacturer',
        'manufactured_at',
        'last_recertification_at',
        'next_recertification_at',
        'tare_weight',
        'current_gas_weight',
    ];

    protected $appends = [
        'site'
    ];

    protected $hidden = [
        'sites'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gases()
    {
        return $this->MorphMany(
            AssetGas::class,
            'owner',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manufacturer()
    {
        return $this->hasOne(CylinderAssetManufacturer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(CylinderAssetLog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function sites()
    {
        return $this->morphedByMany(
            Site::class,
            'owner',
            'cylinder_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function getSiteAttribute()
    {
        return $this->sites()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function gas_transfer()
    {
        return $this->morphedByMany(
            GasTransfer::class,
            'owner',
            'cylinder_asset_owners',
        );
    }
}
