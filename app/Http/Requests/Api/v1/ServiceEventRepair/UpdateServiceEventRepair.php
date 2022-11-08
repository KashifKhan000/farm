<?php

namespace App\Http\Requests\Api\v1\ServiceEventRepair;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class UpdateServiceEventRepair extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'service_event';
        $this->model = ServiceEvent::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'equipment_asset_id' => 'exists:equipment_assets,id',
            'type' => 'in:Service,Leak Repair',
            'parts_required' => 'string',
            'actions' => 'nullable|required_without:actions_other|in:Bypass,Calibrate/Adjust,New Cap/Seal,Relocate,Remove,Repair,Replace,Tighten,Weld,Other',
            'actions_other' => 'nullable|required_without:actions|string',
            'verification_method' => 'nullable|required_if:type,Leak Repair|string|in:ALDS,Alternative,Bubble,Dye,Electronic,Evacuation,Halide,Pressure',
            'verification_method_alternative' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
