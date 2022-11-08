<?php

namespace App\Http\Requests\Api\v1\CylinderAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAsset;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexCylinderAsset extends ApiRequest
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
        $this->model = CylinderAsset::class;
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
