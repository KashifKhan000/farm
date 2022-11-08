<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EquipmentAssetManufacturer\{ IndexEquipmentAssetManufacturer, ShowEquipmentAssetManufacturer, StoreEquipmentAssetManufacturer, UpdateEquipmentAssetManufacturer, DestroyEquipmentAssetManufacturer };
use App\Models\EquipmentAssetManufacturer;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class EquipmentAssetManufacturerController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the equipment_asset_manufacturers.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetManufacturer\IndexEquipmentAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexEquipmentAssetManufacturer $request)
    {
        $fields = $request->validated();
        $equipment_asset_manufacturers = EquipmentAssetManufacturer::select();

        return $this->filtered($equipment_asset_manufacturers, $fields);
    }

    /**
     * Display the specified equipment_asset_manufacturer.
     *
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetManufacturer\ShowEquipmentAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentAssetManufacturer $equipment_asset_manufacturer, ShowEquipmentAssetManufacturer $request)
    {
        return $equipment_asset_manufacturer;
    }

    /**
     * Store a newly created equipment_asset_manufacturer in storage.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetManufacturer\StoreEquipmentAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentAssetManufacturer $request)
    {
        $fields = $request->validated();

        return EquipmentAssetManufacturer::create($fields)->fresh();
    }

    /**
     * Update the specified equipment_asset_manufacturer in storage.
     *
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetManufacturer\UpdateEquipmentAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentAssetManufacturer $equipment_asset_manufacturer, UpdateEquipmentAssetManufacturer $request)
    {
        $fields = $request->validated();

        $equipment_asset_manufacturer->fill($fields);
        $equipment_asset_manufacturer->save();

        return $equipment_asset_manufacturer;
    }

    /**
     * Remove the specified equipment_asset_manufacturer from storage.
     *
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetManufacturer\DestroyEquipmentAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentAssetManufacturer $equipment_asset_manufacturer, DestroyEquipmentAssetManufacturer $request)
    {
        $equipment_asset_manufacturer->delete();
        return response()->json(null, 204);
    }
}
