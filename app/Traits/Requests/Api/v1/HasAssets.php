<?php

namespace App\Traits\Requests\Api\v1;

trait HasAssets
{
    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function equipmentAssetStoreRules($prefix = "")
    {
        if (request('equipment_assets')) {
            return [
                "{$prefix}name" => 'required|string',
                "{$prefix}alias" => 'nullable|string',
                "{$prefix}equipment_classification_id" => 'required|integer|exists:equipment_asset_classifications,id',
                "{$prefix}manufacturer" => 'required|string',
                "{$prefix}gas_id" => 'required|integer|exists:gases,id',
                "{$prefix}operational_status" => 'required|in:Disposed/Destroyed,Mothballed,Normal Operation,Pending Repair All Gas Removed,Planned Retirement,Planned Retrofit,Interim Non-Operation,Seasonal Non-Operation,Seasonal Operation,Shutdown,Sold,Under Repair',
                "{$prefix}regulatory_class" => 'required|in:Comfort Cooling,Industrial Process Cooling,Other,Refrigeration',
                "{$prefix}oil_type" => 'required|in:AB,POE,Mineral',
                "{$prefix}classification_other" => 'nullable|string',
                "{$prefix}model" => 'required|string',
                "{$prefix}model_year" => 'required|string',
                "{$prefix}serial" => 'required|string',
                "{$prefix}manufactured_at" => 'required|date',
                "{$prefix}acquired_at" => "required|date|after:{$prefix}manufactured_at",
                "{$prefix}room_area" => 'required|string',
                "{$prefix}lng" => 'required|numeric',
                "{$prefix}lat" => 'required|numeric',
                "{$prefix}notes" => 'string',
                "{$prefix}shutdown_at" => 'date',
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function equipmentAssetUpdateRules($prefix = "")
    {
        if (request('equipment_assets')) {
            return [
                "{$prefix}name" => 'string',
                "{$prefix}alias" => 'nullable|string',
                "{$prefix}equipment_classification_id" => 'integer|exists:equipment_asset_classifications,id',
                "{$prefix}manufacturer" => 'string',
                "{$prefix}gas_id" => 'integer|exists:gases,id',
                "{$prefix}operational_status" => 'in:Disposed/Destroyed,Mothballed,Normal Operation,Pending Repair All Gas Removed,Planned Retirement,Planned Retrofit,Interim Non-Operation,Seasonal Non-Operation,Seasonal Operation,Shutdown,Sold,Under Repair',
                "{$prefix}regulatory_class" => 'in:Comfort Cooling,Industrial Process Cooling,Other,Refrigeration',
                "{$prefix}oil_type" => 'in:AB,POE,Mineral',
                "{$prefix}classification_other" => 'nullable|string',
                "{$prefix}model" => 'string',
                "{$prefix}model_year" => 'string',
                "{$prefix}serial" => 'string',
                "{$prefix}manufactured_at" => 'date',
                "{$prefix}acquired_at" => "date|after:{$prefix}manufactured_at",
                "{$prefix}charge_before_event" => 'nullable|integer',
                "{$prefix}charge_after_event" => 'nullable|integer',
                "{$prefix}factory_field_charge" => 'integer',
                "{$prefix}charge_calculation_method" => 'in:Default,Other',
                "{$prefix}room_area" => 'string',
                "{$prefix}lng" => 'numeric',
                "{$prefix}lat" => 'numeric',
                "{$prefix}notes" => 'string',
                "{$prefix}shutdown_at" => 'date',
                "{$prefix}image" => 'image',
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function cylinderAssetStoreRules($prefix = "")
    {
        if (!empty(request('cylinder_assets'))) {
            return [
                "{$prefix}cylinder_asset_manufacturer_id" => 'required|exists:cylinder_asset_manufacturers,id',
                "{$prefix}cylinder_size" => 'required|integer',
                "{$prefix}serial_number" => 'required|string',
                "{$prefix}tag_number" => 'required|string',
                "{$prefix}type" => 'required|in:Disposable,Refillable,Recovery',
                "{$prefix}purity_label" => 'required|string',
                "{$prefix}manufactured_at" => 'required|date',
                "{$prefix}last_recertification_at" => "required|date|after:{$prefix}manufactured_at",
                "{$prefix}tare_weight" => 'required|numeric',
                "{$prefix}current_gas_weight" => 'required|integer',
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function cylinderAssetUpdateRules($prefix = "")
    {
        if (!empty(request('cylinder_assets'))) {
            return [
                "{$prefix}cylinder_asset_manufacturer_id" => 'exists:cylinder_asset_manufacturers,id',
                "{$prefix}cylinder_size" => 'integer',
                "{$prefix}serial_number" => 'string',
                "{$prefix}tag_number" => 'string',
                "{$prefix}type" => 'in:Disposable,Refillable,Recovery',
                "{$prefix}purity_label" => 'string',
                "{$prefix}manufactured_at" => 'date',
                "{$prefix}last_recertification_at" => "date|after:{$prefix}manufactured_at",
                "{$prefix}tare_weight" => 'numeric',
                "{$prefix}current_gas_weight" => 'integer',
            ];
        } else {
            return [];
        }
    }
}
