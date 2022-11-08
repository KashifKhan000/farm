<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EquipmentAsset\{ IndexEquipmentAsset, ShowEquipmentAsset, StoreEquipmentAsset, UpdateEquipmentAsset, DestroyEquipmentAsset, StoreEquipmentAssetOCR};
use App\Models\{EquipmentAsset, Gas};
use App\Traits\Controllers\Api\v1\{HasControllerHelpers, HasAssetFields};

class EquipmentAssetController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the equipment_assets.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\IndexEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexEquipmentAsset $request)
    {
        $fields = $request->validated();
        $equipment_assets = EquipmentAsset::select();

        return $this->filtered($equipment_assets, $fields);
    }

    /**
     * Display the specified equipment_asset.
     *
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\ShowEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentAsset $equipment_asset, ShowEquipmentAsset $request)
    {
        return $this->loaded($equipment_asset, 'equipment_asset', 'show');
    }

    /**
     * Store a newly created equipment_asset in storage.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\StoreEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentAsset $request)
    {
        $fields = $request->validated();

        $equipment_asset = EquipmentAsset::create($fields)->fresh();

        $this->attachAssetOwner($fields, $equipment_asset);

        $circuit = $equipment_asset->circuits()->create([
            'name' => 'Primary',
        ]);

        $circuit->gases()->create([
            'gas_id' => $fields['gas_id'],
            'charge' => $fields['charge'],
        ]);

        return $equipment_asset->fresh();
    }

    /**
     * Update the specified equipment_asset in storage.
     *
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\UpdateEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentAsset $equipment_asset, UpdateEquipmentAsset $request)
    {
        $fields = $request->validated();

        $equipment_asset->fill($fields);

        $equipment_asset->save();
        $gas = $equipment_asset->circuits()->whereName('Primary')->first()->gases()->first();

        $this->attachAssetOwner($fields, $equipment_asset);

        if (!empty($fields['charge'])) {
            $gas->charge  = $fields['charge'];
        }

        if (!empty($fields['gas_id'])) {
            $gas->gas_id  = $fields['gas_id'];
        }

        $gas->save();

        return $equipment_asset->fresh();
    }

    /**
     * Remove the specified equipment_asset from storage.
     *
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\DestroyEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentAsset $equipment_asset, DestroyEquipmentAsset $request)
    {
        $equipment_asset->delete();
        return response()->json(null, 204);
    }

    /**
     * Store a newly created equipment_asset in storage.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAsset\StoreEquipmentAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOcrNameplate(EquipmentAsset $equipment_asset, StoreEquipmentAssetOCR $request)
    {
        $fields = array_merge($request->validated(), [
            'is_ocr_scanned' => 1
        ]);

        $equipment_asset->fill($fields);
        $equipment_asset->save();

        return $equipment_asset;
    }
}
