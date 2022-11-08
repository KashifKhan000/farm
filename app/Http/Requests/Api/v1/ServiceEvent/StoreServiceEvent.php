<?php

namespace App\Http\Requests\Api\v1\ServiceEvent;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;
use App\Traits\Requests\Api\v1\{HasServiceEvents, HasAssets};

class StoreServiceEvent extends ApiRequest
{
    use HasServiceEvents, HasAssets;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            $this->equipmentAssetStoreRules('equipment_assets.*.'),
            $this->cylinderAssetStoreRules('cylinder_assets.*.'),
            $this->serviceEventStoreRules()
        );
    }
}
