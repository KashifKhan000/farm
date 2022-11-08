<?php

namespace App\Http\Requests\Api\v1\GasMovement;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\GasMovement;

class UpdateGasMovement extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'gas_movement';
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
            'to_cylinder_asset_id' => 'nullable|exists:cylinder_assets,id',
            'from_cylinder_asset_id' => 'nullable|exists:cylinder_assets,id',
            'to_equipment_asset_id' => 'nullable|exists:equipment_assets,id',
            'from_equipment_asset_id' => 'nullable|exists:equipment_assets,id',
            'gas_id' => 'nullable|exists:gases,id',
            'gas_purity' => 'nullable|integer',
            'gas_quantity' => 'nullable|integer',
            'vacuum_pulled' => 'nullable|integer',
            'vacuum_pulled_unit' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
