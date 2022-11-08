<?php

namespace App\Models;

use App\Traits\Models\IsServiceEventDetail;

use Illuminate\Database\Eloquent\Model;

class ServiceEventShutdownMothball extends Model
{
    use IsServiceEventDetail;

    protected $fillable = [
        'service_event_id',
        'equipment_asset_id',
        'type',
        'parts_required',
        'actions',
        'actions_other',
        'notes',
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];
}
