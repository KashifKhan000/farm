<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EquipmentAssetClassification\{ IndexEquipmentAssetClassification, ShowEquipmentAssetClassification, StoreEquipmentAssetClassification, UpdateEquipmentAssetClassification, DestroyEquipmentAssetClassification };
use App\Models\EquipmentAssetClassification;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class EquipmentAssetClassificationController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the equipment_asset_classifications.
     * 
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetClassification\IndexEquipmentAssetClassification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexEquipmentAssetClassification $request)
    {
        $fields = $request->validated();
        $equipment_asset_classifications = EquipmentAssetClassification::select();

        return $this->filtered($equipment_asset_classifications, $fields);
    }

    /**
     * Display the specified equipment_asset_classification.
     * 
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetClassification\ShowEquipmentAssetClassification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentAssetClassification $equipment_asset_classification, ShowEquipmentAssetClassification $request)
    {
        return $equipment_asset_classification;
    }

    /**
     * Store a newly created equipment_asset_classification in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetClassification\StoreEquipmentAssetClassification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentAssetClassification $request)
    {
        $fields = $request->validated();

        return EquipmentAssetClassification::create($fields)->fresh();
    }

    /**
     * Update the specified equipment_asset_classification in storage.
     * 
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetClassification\UpdateEquipmentAssetClassification  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentAssetClassification $equipment_asset_classification, UpdateEquipmentAssetClassification $request)
    {
        $fields = $request->validated();

        $equipment_asset_classification->fill($fields);
        $equipment_asset_classification->save();

        return $equipment_asset_classification;
    }

    /**
     * Remove the specified equipment_asset_classification from storage.
     * 
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetClassification\DestroyEquipmentAssetClassification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentAssetClassification $equipment_asset_classification, DestroyEquipmentAssetClassification $request)
    {
        $equipment_asset_classification->delete();
        return response()->json(null, 204);
    }
}
