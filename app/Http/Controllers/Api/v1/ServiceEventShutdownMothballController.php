<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventShutdownMothball\{ IndexServiceEventShutdownMothball, ShowServiceEventShutdownMothball, StoreServiceEventShutdownMothball, UpdateServiceEventShutdownMothball, DestroyServiceEventShutdownMothball };
use App\Models\{ServiceEvent, ServiceEventShutdownMothball};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ServiceEventShutdownMothballController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the service_event_shutdown_mothballs.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventShutdownMothball\IndexServiceEventShutdownMothball  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceEvent $service_event, IndexServiceEventShutdownMothball $request)
    {
        $fields = $request->validated();
        $service_event_shutdown_mothballs = ServiceEventShutdownMothball::select();

        return $this->filtered($service_event_shutdown_mothballs, $fields);
    }

    /**
     * Display the specified service_event_shutdown_mothball.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventShutdownMothball  $service_event_shutdown_mothball
     * @param  \App\Http\Requests\Api\v1\ServiceEventShutdownMothball\ShowServiceEventShutdownMothball  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventShutdownMothball $service_event_shutdown_mothball, ShowServiceEventShutdownMothball $request)
    {
        return $service_event_shutdown_mothball;
    }

    /**
     * Store a newly created service_event_shutdown_mothball in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventShutdownMothball\StoreServiceEventShutdownMothball  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventShutdownMothball $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        return ServiceEventShutdownMothball::create($fields)->fresh();
    }

    /**
     * Update the specified service_event_shutdown_mothball in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventShutdownMothball  $service_event_shutdown_mothball
     * @param  \App\Http\Requests\Api\v1\ServiceEventShutdownMothball\UpdateServiceEventShutdownMothball  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventShutdownMothball $service_event_shutdown_mothball, UpdateServiceEventShutdownMothball $request)
    {
        $fields = $request->validated();

        $service_event_shutdown_mothball->fill($fields);
        $service_event_shutdown_mothball->save();

        return $service_event_shutdown_mothball;
    }

    /**
     * Remove the specified service_event_shutdown_mothball from storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventShutdownMothball  $service_event_shutdown_mothball
     * @param  \App\Http\Requests\Api\v1\ServiceEventShutdownMothball\DestroyServiceEventShutdownMothball  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventShutdownMothball $service_event_shutdown_mothball, DestroyServiceEventShutdownMothball $request)
    {
        $service_event_shutdown_mothball->delete();
        return response()->json(null, 204);
    }
}
