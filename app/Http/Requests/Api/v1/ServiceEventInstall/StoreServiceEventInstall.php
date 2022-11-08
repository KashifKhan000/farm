<?php

namespace App\Http\Requests\Api\v1\ServiceEventInstall;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;
use Illuminate\Validation\Rule;

class StoreServiceEventInstall extends ApiRequest
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
        return  [
            'equipment_asset_id' => 'required|exists:equipment_assets,id',
            'gas_id' =>  'required|int|exists:gases,id',
            'type' =>  'required|string|in:Install,Re-Install,Retrofit',
            'parts_required' =>  'required|string',
            'actions' =>  'nullable|required_without:actions_other|string|in:Bypass,Calibrate/Adjust,New Cap/Seal,Relocate,Remove,Repair,Replace,Tighten,Weld,Other',
            'actions_other' =>  'nullable|required_without:actions|string',
            'notes' =>  'nullable|string',
            'new_oil_type' =>  'required|string|in:AB,POE,Mineral',
            'new_factory_field_charge' =>  'required|integer',
        ];
    }
}
