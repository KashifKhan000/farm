<?php

namespace App\Models;

use App\Traits\Models\IsServiceEventDetail;

use Illuminate\Database\Eloquent\Model;

class ServiceEventLeakInspection extends Model
{
    use IsServiceEventDetail;

    protected $fillable = [
        'service_event_id',
        'equipment_asset_id',
        'parts_required',
        'actions',
        'actions_other',
        'detection_method',
        'detection_method_other',
        'alds_used',
        'alds_type',
        'alds_model',
        'inspection_at',
        'leak_found',
        'leak_cause',
        'leak_corrective_action',
        'notes',
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];
}
