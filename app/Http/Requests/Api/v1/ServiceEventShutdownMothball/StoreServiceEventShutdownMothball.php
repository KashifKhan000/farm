<?php

namespace App\Http\Requests\Api\v1\ServiceEventShutdownMothball;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class StoreServiceEventShutdownMothball extends ApiRequest
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
            'type' => 'required|in:Shutdown,Mothball',
            'parts_required' => 'required|string',
            'actions' => 'nullable|required_without:actions_other|required|in:Other,Bypass,Relocate,Remove,Repair,Replace',
            'actions_other' => 'nullable|required_without:actions|string',
            'notes' => 'nullable|string',
        ];
    }
}
