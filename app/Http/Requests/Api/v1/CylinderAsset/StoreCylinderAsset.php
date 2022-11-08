<?php

namespace App\Http\Requests\Api\v1\CylinderAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAsset;

class StoreCylinderAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = CylinderAsset::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'sometimes|required_without:owner_id|int|exists:users,id|is_or_can:store,CylinderAsset',
            'owner_type' => 'required_with:owner_id|sometimes|morphable',
            'owner_id' => 'required_with:owner_type|sometimes|morphable',
            'cylinder_size' => 'required|integer',
            'size_unit' => 'string',
            'serial_number' => 'required|string',
            'tag_number' => 'required|string',
            'type' => 'required|in:Disposable,Refillable,Recovery',
            'purity_label' => 'required|string',
            'manufactured_at' => 'required|date',
            "manufacturer" => 'required|string',
            'last_recertification_at' => 'sometimes|date|after:manufactured_at',
            'next_recertification_at' => 'sometimes|date|after:last_certification_at',
            'tare_weight' => 'required|numeric',
            'tare_unit' => 'string',
            'current_gas_weight' => 'integer'
        ];
    }
}
