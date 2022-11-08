<?php

namespace App\Http\Requests\Api\v1\ServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;
use App\Traits\Requests\Api\v1\{HasServiceEvents, HasAssets};

class UpdateServiceEvent extends ApiRequest
{
    use HasServiceEvents, HasAssets;

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
        return array_merge(
            [
                'contact_name' => 'nullable|string',
                'contact_phone' => 'nullable|string',
                'contact_email' => 'nullable|string',
            ],
            $this->equipmentAssetUpdateRules('equipment_assets.*.'),
            $this->cylinderAssetUpdateRules('cylinder_assets.*.'),
            $this->serviceEventUpdateRules()
        );
    }
}
