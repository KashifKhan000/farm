<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CylinderAssetLog\{ IndexCylinderAssetLog, ShowCylinderAssetLog, StoreCylinderAssetLog, UpdateCylinderAssetLog, DestroyCylinderAssetLog };
use App\Models\CylinderAssetLog;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class CylinderAssetLogController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the cylinder_asset_logs.
     * 
     * @param  \App\Http\Requests\Api\v1\CylinderAssetLog\IndexCylinderAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCylinderAssetLog $request)
    {
        $fields = $request->validated();
        $cylinder_asset_logs = CylinderAssetLog::select();

        return $this->filtered($cylinder_asset_logs, $fields);
    }

    /**
     * Display the specified cylinder_asset_log.
     * 
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * @param  \App\Http\Requests\Api\v1\CylinderAssetLog\ShowCylinderAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CylinderAssetLog $cylinder_asset_log, ShowCylinderAssetLog $request)
    {
        return $cylinder_asset_log;
    }

    /**
     * Store a newly created cylinder_asset_log in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\CylinderAssetLog\StoreCylinderAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCylinderAssetLog $request)
    {
        $fields = $request->validated();

        return CylinderAssetLog::create($fields)->fresh();
    }

    /**
     * Update the specified cylinder_asset_log in storage.
     * 
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * @param  \App\Http\Requests\Api\v1\CylinderAssetLog\UpdateCylinderAssetLog  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CylinderAssetLog $cylinder_asset_log, UpdateCylinderAssetLog $request)
    {
        $fields = $request->validated();

        $cylinder_asset_log->fill($fields);
        $cylinder_asset_log->save();

        return $cylinder_asset_log;
    }

    /**
     * Remove the specified cylinder_asset_log from storage.
     * 
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * @param  \App\Http\Requests\Api\v1\CylinderAssetLog\DestroyCylinderAssetLog  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CylinderAssetLog $cylinder_asset_log, DestroyCylinderAssetLog $request)
    {
        $cylinder_asset_log->delete();
        return response()->json(null, 204);
    }
}
