<?php

namespace App\Http\Requests\Api\v1\EquipmentAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexEquipmentAsset extends ApiRequest
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
        $this->model = EquipmentAsset::class;
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
