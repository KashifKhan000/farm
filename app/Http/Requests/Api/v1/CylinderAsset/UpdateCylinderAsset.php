<?php

namespace App\Http\Requests\Api\v1\CylinderAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAsset;

class UpdateCylinderAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'cylinder_asset';
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
            'owner_type' => 'sometimes|morphable|ownable',
            'owner_id' => 'sometimes|morphable|ownable',
            'cylinder_size' => 'integer',
            'size_unit' => 'string',
            'serial_number' => 'string',
            'tag_number' => 'string',
            'type' => 'in:Disposable,Refillable,Recovery',
            'purity_label' => 'string',
            'manufacturer' => 'string',
            'manufactured_at' => 'date',
            'last_recertification_at' => 'date|after:manufactured_at',
            'next_recertification_at' => 'date|after:last_certification_at',
            'tare_weight' => 'numeric',
            'tare_unit' => 'string',
            'current_gas_weight' => 'integer'
        ];
    }
}
