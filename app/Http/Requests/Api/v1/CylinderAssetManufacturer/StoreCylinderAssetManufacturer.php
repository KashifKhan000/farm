<?php

namespace App\Http\Requests\Api\v1\CylinderAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetManufacturer;

class StoreCylinderAssetManufacturer extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
