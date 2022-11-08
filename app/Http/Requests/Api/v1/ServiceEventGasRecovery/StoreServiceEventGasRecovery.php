<?php

namespace App\Http\Requests\Api\v1\ServiceEventGasRecovery;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ServiceEvent;

class StoreServiceEventGasRecovery extends ApiRequest
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
            'equipment_asset_id' => 'required_with:equipment_asset_circuit_id|exists:equipment_assets,id',
            'equipment_asset_circuit_id' => 'required_with:equipment_asset_id|exists:equipment_asset_circuits,id',
            'recovery_equipment_id' => 'sometimes|exists:recovery_equipment,id',
            'gas_recoveries_from.*.from_cylinder_asset_id' => 'exists:cylinder_assets,id',
            'gas_recoveries_from.*.from_equipment_asset_id' => 'required_with:gas_recoveries_from.*.from_equipment_asset_circuit_id|exists:equipment_assets,id',
            'gas_recoveries_from.*.from_equipment_asset_circuit_id' => 'required_with:gas_recoveries_from.*.from_equipment_asset_id|exists:equipment_asset_circuits,id',
            'gas_recoveries_from.*.gas_quantity' => 'required_with:gas_recoveries_from|integer',
            'gas_recoveries_to.*.to_cylinder_asset_id' => 'exists:cylinder_assets,id',
            'gas_recoveries_to.*.gas_quantity' => 'required_with:gas_recoveries_to|integer',
        ];
    }
}
