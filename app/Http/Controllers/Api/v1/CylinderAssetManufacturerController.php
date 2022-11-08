<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CylinderAssetManufacturer\{ IndexCylinderAssetManufacturer, ShowCylinderAssetManufacturer, StoreCylinderAssetManufacturer, UpdateCylinderAssetManufacturer, DestroyCylinderAssetManufacturer };
use App\Models\CylinderAssetManufacturer;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class CylinderAssetManufacturerController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the cylinder_asset_manufacturers.
     * 
     * @param  \App\Http\Requests\Api\v1\CylinderAssetManufacturer\IndexCylinderAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCylinderAssetManufacturer $request)
    {
        $fields = $request->validated();
        $cylinder_asset_manufacturers = CylinderAssetManufacturer::select();

        return $this->filtered($cylinder_asset_manufacturers, $fields);
    }

    /**
     * Display the specified cylinder_asset_manufacturer.
     * 
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\CylinderAssetManufacturer\ShowCylinderAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CylinderAssetManufacturer $cylinder_asset_manufacturer, ShowCylinderAssetManufacturer $request)
    {
        return $cylinder_asset_manufacturer;
    }

    /**
     * Store a newly created cylinder_asset_manufacturer in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\CylinderAssetManufacturer\StoreCylinderAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCylinderAssetManufacturer $request)
    {
        $fields = $request->validated();

        return CylinderAssetManufacturer::create($fields)->fresh();
    }

    /**
     * Update the specified cylinder_asset_manufacturer in storage.
     * 
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\CylinderAssetManufacturer\UpdateCylinderAssetManufacturer  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CylinderAssetManufacturer $cylinder_asset_manufacturer, UpdateCylinderAssetManufacturer $request)
    {
        $fields = $request->validated();

        $cylinder_asset_manufacturer->fill($fields);
        $cylinder_asset_manufacturer->save();

        return $cylinder_asset_manufacturer;
    }

    /**
     * Remove the specified cylinder_asset_manufacturer from storage.
     * 
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     * @param  \App\Http\Requests\Api\v1\CylinderAssetManufacturer\DestroyCylinderAssetManufacturer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CylinderAssetManufacturer $cylinder_asset_manufacturer, DestroyCylinderAssetManufacturer $request)
    {
        $cylinder_asset_manufacturer->delete();
        return response()->json(null, 204);
    }
}
