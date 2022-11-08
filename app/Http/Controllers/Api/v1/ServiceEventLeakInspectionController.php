<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventLeakInspection\{ IndexServiceEventLeakInspection, ShowServiceEventLeakInspection, StoreServiceEventLeakInspection, UpdateServiceEventLeakInspection, DestroyServiceEventLeakInspection };
use App\Models\{ServiceEvent, ServiceEventLeakInspection};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ServiceEventLeakInspectionController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the service_event_leak_inspections.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventLeakInspection\IndexServiceEventLeakInspection  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceEvent $service_event, IndexServiceEventLeakInspection $request)
    {
        $fields = $request->validated();
        $service_event_leak_inspections = ServiceEventLeakInspection::select();

        return $this->filtered($service_event_leak_inspections, $fields);
    }

    /**
     * Display the specified service_event_leak_inspection.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventLeakInspection  $service_event_leak_inspection
     * @param  \App\Http\Requests\Api\v1\ServiceEventLeakInspection\ShowServiceEventLeakInspection  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventLeakInspection $service_event_leak_inspection, ShowServiceEventLeakInspection $request)
    {
        return $service_event_leak_inspection;
    }

    /**
     * Store a newly created service_event_leak_inspection in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventLeakInspection\StoreServiceEventLeakInspection  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventLeakInspection $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        return ServiceEventLeakInspection::create($fields)->fresh();
    }

    /**
     * Update the specified service_event_leak_inspection in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventLeakInspection  $service_event_leak_inspection
     * @param  \App\Http\Requests\Api\v1\ServiceEventLeakInspection\UpdateServiceEventLeakInspection  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventLeakInspection $service_event_leak_inspection, UpdateServiceEventLeakInspection $request)
    {
        $fields = $request->validated();

        $service_event_leak_inspection->fill($fields);
        $service_event_leak_inspection->save();

        return $service_event_leak_inspection;
    }

    /**
     * Remove the specified service_event_leak_inspection from storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventLeakInspection  $service_event_leak_inspection
     * @param  \App\Http\Requests\Api\v1\ServiceEventLeakInspection\DestroyServiceEventLeakInspection  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventLeakInspection $service_event_leak_inspection, DestroyServiceEventLeakInspection $request)
    {
        $service_event_leak_inspection->delete();
        return response()->json(null, 204);
    }
}
