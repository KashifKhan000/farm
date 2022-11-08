<?php

namespace App\Http\Requests\Api\v1\CylinderAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAsset;

class ShowCylinderAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'cylinder_asset';
        $this->model = CylinderAsset::class;
    }
}
