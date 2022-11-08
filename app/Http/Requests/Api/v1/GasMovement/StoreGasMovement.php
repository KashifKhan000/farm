<?php

namespace App\Http\Requests\Api\v1\GasMovement;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GasMovement;

class StoreGasMovement extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = GasMovement::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'required|morphable|ownable',
            'owner_type' => 'required|morphable|ownable',
            'recovery_equipment_id' => 'nullable|exists:recovery_equipment,id|is_or_can:update,RecoveryEquipment',
            'to_cylinder_asset_id' => 'nullable|exists:cylinder_assets,id',
            'from_cylinder_asset_id' => 'nullable|exists:cylinder_assets,id',
            'to_equipment_asset_circuit_id' => 'nullable|exists:equipment_asset_circuits,id',
            'from_equipment_asset_circuit_id' => 'nullable|exists:equipment_asset_circuits,id',
            'gas_quantity' => 'nullable|integer',
            'vacuum_pulled' => 'nullable|integer',
            'vacuum_pulled_unit' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
