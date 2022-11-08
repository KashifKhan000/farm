<?php

namespace App\Http\Requests\Api\v1\EquipmentAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;

class DestroyEquipmentAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'equipment_asset';
        $this->model = EquipmentAsset::class;
    }
}
