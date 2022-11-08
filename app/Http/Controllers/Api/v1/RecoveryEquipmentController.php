<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\RecoveryEquipment\{ IndexRecoveryEquipment, ShowRecoveryEquipment, StoreRecoveryEquipment, UpdateRecoveryEquipment, DestroyRecoveryEquipment };
use App\Models\RecoveryEquipment;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class RecoveryEquipmentController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the recovery_equipments.
     *
     * @param  \App\Http\Requests\Api\v1\RecoveryEquipment\IndexRecoveryEquipment  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRecoveryEquipment $request)
    {
        $fields = $request->validated();
        $recovery_equipments = RecoveryEquipment::select();

        return $this->filtered($recovery_equipments, $fields);
    }

    /**
     * Display the specified recovery_equipment.
     *
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     * @param  \App\Http\Requests\Api\v1\RecoveryEquipment\ShowRecoveryEquipment  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(RecoveryEquipment $recovery_equipment, ShowRecoveryEquipment $request)
    {
        return $recovery_equipment;
    }

    /**
     * Store a newly created recovery_equipment in storage.
     *
     * @param  \App\Http\Requests\Api\v1\RecoveryEquipment\StoreRecoveryEquipment  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecoveryEquipment $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id()
        ]);

        return RecoveryEquipment::create($fields)->fresh();
    }

    /**
     * Update the specified recovery_equipment in storage.
     *
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     * @param  \App\Http\Requests\Api\v1\RecoveryEquipment\UpdateRecoveryEquipment  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RecoveryEquipment $recovery_equipment, UpdateRecoveryEquipment $request)
    {
        $fields = $request->validated();

        $recovery_equipment->fill($fields);
        $recovery_equipment->save();

        return $recovery_equipment;
    }

    /**
     * Remove the specified recovery_equipment from storage.
     *
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     * @param  \App\Http\Requests\Api\v1\RecoveryEquipment\DestroyRecoveryEquipment  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecoveryEquipment $recovery_equipment, DestroyRecoveryEquipment $request)
    {
        $recovery_equipment->delete();
        return response()->json(null, 204);
    }
}
