<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetCircuit;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;

class UpdateEquipmentAssetCircuit extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'equipment_asset';
        $this->model = EquipmentAsset::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'gas_id' => 'integer|exists:gases,id',
            'charge' => 'integer',
            'notes' => 'string',
            'gases' => 'required',
            'gases.*.gas_id' => 'required_with:gases.*.gas_id|integer|exists:gases,id',
            'gases.*.purity' => 'required_with:gases.*.gas_id|integer',
        ];
    }
}
