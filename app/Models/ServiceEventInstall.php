<?php

namespace App\Models;

use App\Traits\Models\IsServiceEventDetail;

use Illuminate\Database\Eloquent\Model;

class ServiceEventInstall extends Model
{
    use IsServiceEventDetail;

    protected $fillable = [
        'equipment_asset_id',
        'service_event_id',
        'gas_id',
        'type',
        'parts_required',
        'actions',
        'actions_other',
        'notes',
        'new_oil_type',
        'new_gas_type',
        'new_factory_field_charge',
    ];

    protected $with = [
        'images',
        'videos',
        'gas_transfer'
    ];


}
