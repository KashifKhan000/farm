<?php

namespace App\Models;

use App\Traits\Models\{IsServiceEventDetail, HasAssets};

use Illuminate\Database\Eloquent\Model;

class ServiceEventGasCharge extends Model
{
    use IsServiceEventDetail, HasAssets;

    protected $fillable = [
        'service_event_id',
        'equipment_asset_id'
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];


}
