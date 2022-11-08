<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventGasRecovery\{ IndexServiceEventGasRecovery, ShowServiceEventGasRecovery, StoreServiceEventGasRecovery, UpdateServiceEventGasRecovery, DestroyServiceEventGasRecovery };
use App\Models\{EquipmentAsset, ServiceEvent, ServiceEventGasRecovery, GasMovement};
use App\Traits\Controllers\Api\v1\{HasControllerHelpers, HasAssetFields};

class ServiceEventGasRecoveryController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the service_event_gas_recoveries.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasRecovery\IndexServiceEventGasRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexServiceEventGasRecovery $request)
    {
        $fields = $request->validated();
        $service_event_gas_recoveries = ServiceEventGasRecovery::select();

        return $this->filtered($service_event_gas_recoveries, $fields);
    }

    /**
     * Display the specified service_event_gas_recovery.
     *
     * @param  \App\Models\ServiceEventGasRecovery  $service_event_gas_recovery
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasRecovery\ShowServiceEventGasRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventGasRecovery $service_event_gas_recovery, ShowServiceEventGasRecovery $request)
    {
        return $this->loaded($service_event_gas_recovery, 'service_event_gas_recovery', 'show');
    }

    /**
     * Store a newly created service_event_gas_recovery in storage.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasRecovery\StoreServiceEventGasRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventGasRecovery $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        /** Ensure that the amount of gas recovered does not exceed the amount deposited  */
        if ($this->gasRecoveryAmountExceeded($fields) === true) {
            return response()->json([
                'message' => trans('fmhero.gas_recovery_exceeded')
            ], 422);
        };

        $service_event_gas_recovery = ServiceEventGasRecovery::create($fields);
        $gas_transfer = $service_event_gas_recovery->gas_transfer()->create($fields);

        $this->addGasRecoveries($service_event_gas_recovery, $fields, $gas_transfer);

        return $this->loaded($service_event_gas_recovery, 'service_event_gas_recovery', 'store');
    }

    /**
     * Update the specified service_event_gas_recovery in storage.
     *
     * @param  \App\Models\ServiceEventGasRecovery  $service_event_gas_recovery
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasRecovery\UpdateServiceEventGasRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventGasRecovery $service_event_gas_recovery, UpdateServiceEventGasRecovery $request)
    {
        $fields = $request->validated();

        /** Ensure that the amount of gas recovered does not exceed the amount deposited  */
        if ($this->gasRecoveryAmountExceeded($fields) === true) {
            return response()->json([
                'message' => trans('fmhero.gas_recovery_exceeded')
            ], 422);
        };

        $service_event_gas_recovery->fill($fields);
        $service_event_gas_recovery->save();

        $gas_transfer = $service_event_gas_recovery->gas_transfer()->first();

        $gas_transfer->gas_movements()->delete();

        $gas_transfer->fill($fields);
        $gas_transfer->save();

        $this->addGasRecoveries($service_event_gas_recovery, $fields, $gas_transfer);

        return $this->loaded($service_event_gas_recovery->fresh(), 'service_event_gas_recovery', 'update');
    }

    /**
     * Remove the specified service_event_gas_recovery from storage.
     *
     * @param  \App\Models\ServiceEventGasRecovery  $service_event_gas_recovery
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasRecovery\DestroyServiceEventGasRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventGasRecovery $service_event_gas_recovery, DestroyServiceEventGasRecovery $request)
    {
        $service_event_gas_recovery->delete();
        return response()->json(null, 204);
    }
}
