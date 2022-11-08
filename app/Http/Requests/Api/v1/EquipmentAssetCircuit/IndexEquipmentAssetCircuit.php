<?php

namespace App\Http\Requests\Api\v1\EquipmentAssetCircuit;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAssetCircuit;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexEquipmentAssetCircuit extends ApiRequest
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
        $this->model = EquipmentAssetCircuit::class;
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
