<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetClassification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetClassification;

class UpdateEquipmentAssetClassification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'equipment_asset_classification';
        $this->model = EquipmentAssetClassification::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }
}
