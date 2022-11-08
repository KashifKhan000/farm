<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetClassification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetClassification;

class ShowEquipmentAssetClassification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'equipment_asset_classification';
        $this->model = EquipmentAssetClassification::class;
    }
}
