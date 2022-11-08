<?php

namespace App\Models;

use App\Traits\Models\IsServiceEventDetail;

use Illuminate\Database\Eloquent\Model;

class ServiceEventRepair extends Model
{
    use IsServiceEventDetail;

    protected $fillable = [
        'equipment_asset_id',
        'service_event_id',
        'type',
        'parts_required',
        'actions',
        'actions_other',
        'vertification_method',
        'vertification_method_alternative',
        'notes',
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];
}
