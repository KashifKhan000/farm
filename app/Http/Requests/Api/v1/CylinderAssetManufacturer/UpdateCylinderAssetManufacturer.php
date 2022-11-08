<?php

namespace App\Http\Requests\Api\v1\CylinderAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetManufacturer;

class UpdateCylinderAssetManufacturer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'cylinder_asset_manufacturer';
        $this->model = CylinderAssetManufacturer::class;
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
