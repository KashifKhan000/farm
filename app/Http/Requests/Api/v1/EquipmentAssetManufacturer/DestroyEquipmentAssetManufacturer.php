<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetManufacturer;

class DestroyEquipmentAssetManufacturer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'equipment_asset_manufacturer';
        $this->model = EquipmentAssetManufacturer::class;
    }
}
