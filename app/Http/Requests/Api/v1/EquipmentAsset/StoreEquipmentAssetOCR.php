<?php

namespace App\Http\Requests\Api\v1\EquipmentAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;

use App\Traits\Requests\Api\v1\HasAssets;

class StoreEquipmentAssetOCR extends ApiRequest
{
    use HasAssets;

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
            "manufacturer" => 'nullable|string',
            "model" => 'required|string',
            "model_year" => 'nullable|string',
            "manufactured_at" => 'nullable|date',
            "serial" => 'required|string',
            "gas_id" => 'nullable|integer|exists:gases,id',
            "factory_field_charge" => 'nullable|integer',
        ];
    }
}
