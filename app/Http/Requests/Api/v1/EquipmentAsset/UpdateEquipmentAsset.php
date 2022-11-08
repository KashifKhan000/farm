<?php

namespace App\Http\Requests\Api\v1\EquipmentAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;

class UpdateEquipmentAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'equipment_asset';
        $this->model = EquipmentAsset::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'sometimes|morphable|ownable',
            'owner_type' => 'sometimes|morphable|ownable',
            'name' => 'string',
            'alias' => 'nullable|string',
            'equipment_classification_id' => 'nullable|integer|exists:equipment_asset_classifications,id',
            'gas_id' => 'integer|exists:gases,id',
            'charge' => 'integer',
            'manufacturer' => 'string',
            'operational_status' => 'nullable|in:Disposed/Destroyed,Mothballed,Normal Operation,Pending Repair All Gas Removed,Planned Retirement,Planned Retrofit,Interim Non-Operation,Seasonal Non-Operation,Seasonal Operation,Shutdown,Sold,Under Repair',
            'regulatory_class' => 'in:Comfort Cooling,Industrial Process Cooling,Other,Refrigeration',
            'oil_type' => 'nullable|in:AB,POE,Mineral',
            'classification_other' => 'nullable|string',
            'model' => 'string',
            'model_year' => 'string',
            'serial' => 'string',
            'manufactured_at' => 'nullable|date',
            'acquired_at' => 'nullable|date|after:manufactured_at',
            'room_area' => 'nullable|string',
            'lng' => 'nullable|numeric',
            'lat' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'shutdown_at' => 'nullable|date',
        ];
    }
}
