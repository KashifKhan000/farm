<?php

namespace App\Http\Requests\Api\v1\ServiceEventScrap;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class StoreServiceEventScrap extends ApiRequest
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
            'type' => 'required|string|in:Remove,Replace,Other',
            'is_flat' => 'required|boolean',
            'notes' => 'nullable|string',
        ];
    }
}
