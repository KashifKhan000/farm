<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetManufacturer;

class UpdateEquipmentAssetManufacturer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'equipment_asset_manufacturer';
        $this->model = EquipmentAssetManufacturer::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
