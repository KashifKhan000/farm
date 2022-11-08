<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetClassification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetClassification;

class StoreEquipmentAssetClassification extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
