<?php

namespace App\Http\Requests\Api\v1\CylinderAssetManufacturer;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAssetManufacturer;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexCylinderAssetManufacturer extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = CylinderAssetManufacturer::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
