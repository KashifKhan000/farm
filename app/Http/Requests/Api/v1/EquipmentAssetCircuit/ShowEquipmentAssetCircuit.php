<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetCircuit;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetCircuit;

class ShowEquipmentAssetCircuit extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'equipment_asset_circuit';
        $this->model = EquipmentAssetCircuit::class;
    }
}
