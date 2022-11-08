<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventRepair\{ IndexServiceEventRepair, ShowServiceEventRepair, StoreServiceEventRepair, UpdateServiceEventRepair, DestroyServiceEventRepair };
use App\Models\{ServiceEvent, ServiceEventRepair};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ServiceEventRepairController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the service_event_repairs.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventRepair\IndexServiceEventRepair  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceEvent $service_event, IndexServiceEventRepair $request)
    {
        $fields = $request->validated();
        $service_event_repairs = ServiceEventRepair::select();

        return $this->filtered($service_event_repairs, $fields);
    }

    /**
     * Display the specified service_event_repair.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventRepair  $service_event_repair
     * @param  \App\Http\Requests\Api\v1\ServiceEventRepair\ShowServiceEventRepair  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventRepair $service_event_repair, ShowServiceEventRepair $request)
    {
        return $service_event_repair;
    }

    /**
     * Store a newly created service_event_repair in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventRepair\StoreServiceEventRepair  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventRepair $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        return ServiceEventRepair::create($fields)->fresh();
    }

    /**
     * Update the specified service_event_repair in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventRepair  $service_event_repair
     * @param  \App\Http\Requests\Api\v1\ServiceEventRepair\UpdateServiceEventRepair  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventRepair $service_event_repair, UpdateServiceEventRepair $request)
    {
        $fields = $request->validated();

        $service_event_repair->fill($fields);
        $service_event_repair->save();

        return $service_event_repair;
    }

    /**
     * Remove the specified service_event_repair from storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventRepair  $service_event_repair
     * @param  \App\Http\Requests\Api\v1\ServiceEventRepair\DestroyServiceEventRepair  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventRepair $service_event_repair, DestroyServiceEventRepair $request)
    {
        $service_event_repair->delete();
        return response()->json(null, 204);
    }
}
