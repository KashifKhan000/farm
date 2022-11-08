<?php

namespace App\Http\Requests\Api\v1\ServiceEventLeakInspection;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class StoreServiceEventLeakInspection extends ApiRequest
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
            'equipment_asset_id' => 'required|exists:equipment_assets,id',
            'actions' => 'nullable|required_without:actions_other|in:Bypass,Calibrate/Adjust,New Cap/Seal,Relocate,Remove,Repair,Replace,Tighten,Weld,Other',
            'actions_other' => 'nullable|required_without:actions|string',
            'detection_method' => 'nullable|required_without:detection_method_other|in:Alternative,Bubble,Dye,Electronic Ultrasonic,Evacuate,Pressure Test,Halide',
            'detection_method_other' => 'nullable|required_without:detection_method',
            'alds_used' => 'required|boolean',
            'alds_type' => 'required_if:alds_used,1|nullable|in:Direct,Indirect',
            'alds_model' => 'required_if:alds_used,1|nullable|string',
            'inspection_at' => 'nullable|required_if:alds_used,1|date',
            'leak_found' => 'required|boolean',
            'leak_cause' => 'required_if:leak_found,1|nullable|in:Rub Out,Joint Failure,Corrosion,Vibration,Abuse,Warranty,Seal Failure,Rupture,Catastrophe,Mechanical Failure,ALDS',
            'leak_corrective_action' => 'required_if:leak_found,1|nullable|in:Notify Engineering,Scheduled Repair,Removed From Service,Planned Retrofit,Waiting On Parts',
            'notes' => 'nullable|string',
        ];
    }
}
