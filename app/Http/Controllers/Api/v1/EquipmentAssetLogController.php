<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EquipmentAssetLog\{ IndexEquipmentAssetLog, ShowEquipmentAssetLog, StoreEquipmentAssetLog, UpdateEquipmentAssetLog, DestroyEquipmentAssetLog };
use App\Models\EquipmentAssetLog;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class EquipmentAssetLogController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the equipment_asset_logs.
     * 
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetLog\IndexEquipmentAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexEquipmentAssetLog $request)
    {
        $fields = $request->validated();
        $equipment_asset_logs = EquipmentAssetLog::select();

        return $this->filtered($equipment_asset_logs, $fields);
    }

    /**
     * Display the specified equipment_asset_log.
     * 
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetLog\ShowEquipmentAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentAssetLog $equipment_asset_log, ShowEquipmentAssetLog $request)
    {
        return $equipment_asset_log;
    }

    /**
     * Store a newly created equipment_asset_log in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetLog\StoreEquipmentAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentAssetLog $request)
    {
        $fields = $request->validated();

        return EquipmentAssetLog::create($fields)->fresh();
    }

    /**
     * Update the specified equipment_asset_log in storage.
     * 
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetLog\UpdateEquipmentAssetLog  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentAssetLog $equipment_asset_log, UpdateEquipmentAssetLog $request)
    {
        $fields = $request->validated();

        $equipment_asset_log->fill($fields);
        $equipment_asset_log->save();

        return $equipment_asset_log;
    }

    /**
     * Remove the specified equipment_asset_log from storage.
     * 
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetLog\DestroyEquipmentAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentAssetLog $equipment_asset_log, DestroyEquipmentAssetLog $request)
    {
        $equipment_asset_log->delete();
        return response()->json(null, 204);
    }
}
