<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventGasCharge\{ IndexServiceEventGasCharge, ShowServiceEventGasCharge, StoreServiceEventGasCharge, UpdateServiceEventGasCharge, DestroyServiceEventGasCharge };
use App\Models\{ServiceEvent, ServiceEventGasCharge, EquipmentAsset};
use App\Traits\Controllers\Api\v1\{HasControllerHelpers, HasAssetFields};

class ServiceEventGasChargeController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the service_event_gas_charges.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasCharge\IndexServiceEventGasCharge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexServiceEventGasCharge $request)
    {
        $fields = $request->validated();
        $service_event_gas_charges = ServiceEventGasCharge::select();

        return $this->filtered($service_event_gas_charges, $fields);
    }

    /**
     * Display the specified service_event_gas_charge.
     *
     * @param  \App\Models\ServiceEventGasCharge  $service_event_gas_charge
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasCharge\ShowServiceEventGasCharge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventGasCharge $service_event_gas_charge, ShowServiceEventGasCharge $request)
    {
        return $service_event_gas_charge;
    }

    /**
     * Store a newly created service_event_gas_charge in storage.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasCharge\StoreServiceEventGasCharge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventGasCharge $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        $service_event_gas_charge = ServiceEventGasCharge::create($fields);

        $gas_transfer = $service_event_gas_charge->gas_transfer()->create();

        $this->addGasCharges($service_event_gas_charge, $fields, $gas_transfer);

        return $service_event_gas_charge->fresh();
    }

    /**
     * Update the specified service_event_gas_charge in storage.
     *
     * @param  \App\Models\ServiceEventGasCharge  $service_event_gas_charge
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasCharge\UpdateServiceEventGasCharge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventGasCharge $service_event_gas_charge, UpdateServiceEventGasCharge $request)
    {
        $fields = $request->validated();

        $service_event_gas_charge->fill($fields);
        $service_event_gas_charge->save();

        $gas_transfer = $service_event_gas_charge->gas_transfer()->first();

        $this->addGasCharges($service_event_gas_charge, $fields, $gas_transfer);

        return $service_event_gas_charge->fresh();
    }

    /**
     * Remove the specified service_event_gas_charge from storage.
     *
     * @param  \App\Models\ServiceEventGasCharge  $service_event_gas_charge
     * @param  \App\Http\Requests\Api\v1\ServiceEventGasCharge\DestroyServiceEventGasCharge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventGasCharge $service_event_gas_charge, DestroyServiceEventGasCharge $request)
    {
        $service_event_gas_charge->delete();
        return response()->json(null, 204);
    }
}
