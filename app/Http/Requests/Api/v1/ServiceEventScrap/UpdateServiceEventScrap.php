<?php

namespace App\Http\Requests\Api\v1\ServiceEventScrap;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class UpdateServiceEventScrap extends ApiRequest
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
            'type' => 'string|in:Remove,Replace,Other',
            'is_flat' => 'boolean',
            'notes' => 'nullable|string',
        ];
    }
}
