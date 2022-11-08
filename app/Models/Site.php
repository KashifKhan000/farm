<?php

namespace App\Models;

use App\Traits\Models\{HasAddresses, HasAssets};

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasAddresses, HasAssets;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'owner_type',
        'owner_id',
        'name',
    ];

    protected $with = [
        'address',
        'equipment_assets'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_events()
    {
        return $this->hasMany(ServiceEvent::class);
    }
}
