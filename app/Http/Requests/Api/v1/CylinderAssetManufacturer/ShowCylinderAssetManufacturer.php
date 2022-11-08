<?php

namespace App\Http\Requests\Api\v1\CylinderAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetManufacturer;

class ShowCylinderAssetManufacturer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'cylinder_asset_manufacturer';
        $this->model = CylinderAssetManufacturer::class;
    }
}
