<?php

namespace App\Http\Requests\Api\v1\ServiceEventGasCharge;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class StoreServiceEventGasCharge extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'service_event';
        $this->model = ServiceEvent::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'equipment_asset_id' => 'required|exists:equipment_assets,id',
            'recovery_equipment_id' => 'sometimes|exists:recovery_equipment,id',
            'gas_charges.*.from_cylinder_asset_id' => 'required_with:gas_charges|exists:cylinder_assets,id',
            'gas_charges.*.to_equipment_asset_circuit_id' => 'required_with:gas_charges|integer|exists:equipment_asset_circuits,id',
            'gas_charges.*.gas_quantity' => 'required_with:gas_charges|integer',
        ];
    }
}
