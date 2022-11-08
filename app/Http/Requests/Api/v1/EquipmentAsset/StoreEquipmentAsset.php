<?php

namespace App\Http\Requests\Api\v1\EquipmentAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\EquipmentAsset;

use App\Traits\Requests\Api\v1\HasAssets;

class StoreEquipmentAsset extends ApiRequest
{
    use HasAssets;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            'owner_id' => 'required|integer|morphable|ownable',
            'owner_type' => 'required|morphable|ownable',
            "gas_id" => "required|integer|exists:gases,id",
            "charge" => "required|integer",
            'name' => 'string',
            'alias' => 'nullable|string',
            'equipment_classification_id' => 'nullable|integer|exists:equipment_asset_classifications,id',
            'manufacturer' => 'required|string',
            'operational_status' => 'nullable|in:Disposed/Destroyed,Mothballed,Normal Operation,Pending Repair All Gas Removed,Planned Retirement,Planned Retrofit,Interim Non-Operation,Seasonal Non-Operation,Seasonal Operation,Shutdown,Sold,Under Repair',
            'regulatory_class' => 'required|in:Comfort Cooling,Industrial Process Cooling,Other,Refrigeration',
            'oil_type' => 'nullable|in:AB,POE,Mineral',
            'classification_other' => 'nullable|string',
            'model' => 'required|string',
            'model_year' => 'required|string',
            'serial' => 'required|string',
            'is_ocr_scanned' => 'sometimes|boolean',
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
