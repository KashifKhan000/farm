<?php

namespace App\Models;

use App\Traits\Models\IsServiceEventDetail;

use Illuminate\Database\Eloquent\Model;

class ServiceEventScrap extends Model
{
    use IsServiceEventDetail;

    protected $fillable = [
        'service_event_id',
        'equipment_asset_id',
        'type',
        'is_flat',
        'notes',
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];
}
