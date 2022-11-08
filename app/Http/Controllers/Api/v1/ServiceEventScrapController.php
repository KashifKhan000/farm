<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventScrap\{ IndexServiceEventScrap, ShowServiceEventScrap, StoreServiceEventScrap, UpdateServiceEventScrap, DestroyServiceEventScrap };
use App\Models\{ServiceEvent, ServiceEventScrap};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ServiceEventScrapController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the service_event_scraps.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventScrap\IndexServiceEventScrap  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IServiceEvent $service_event, IndexServiceEventScrap $request)
    {
        $fields = $request->validated();
        $service_event_scraps = ServiceEventScrap::select();

        return $this->filtered($service_event_scraps, $fields);
    }

    /**
     * Display the specified service_event_scrap.
     *
     * @param  \App\Models\ServiceEventScrap  $service_event_scrap
     * @param  \App\Http\Requests\Api\v1\ServiceEventScrap\ShowServiceEventScrap  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventScrap $service_event_scrap, ShowServiceEventScrap $request)
    {
        return $service_event_scrap;
    }

    /**
     * Store a newly created service_event_scrap in storage.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEventScrap\StoreServiceEventScrap  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventScrap $request)
    {
        $fields = array_merge($request->validated(), [
            'service_event_id' => $service_event->id,
        ]);

        return ServiceEventScrap::create($fields)->fresh();
    }

    /**
     * Update the specified service_event_scrap in storage.
     *
     * @param  \App\Models\ServiceEventScrap  $service_event_scrap
     * @param  \App\Http\Requests\Api\v1\ServiceEventScrap\UpdateServiceEventScrap  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventScrap $service_event_scrap, UpdateServiceEventScrap $request)
    {
        $fields = $request->validated();

        $service_event_scrap->fill($fields);
        $service_event_scrap->save();

        return $service_event_scrap;
    }

    /**
     * Remove the specified service_event_scrap from storage.
     *
     * @param  \App\Models\ServiceEventScrap  $service_event_scrap
     * @param  \App\Http\Requests\Api\v1\ServiceEventScrap\DestroyServiceEventScrap  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventScrap $service_event_scrap, DestroyServiceEventScrap $request)
    {
        $service_event_scrap->delete();
        return response()->json(null, 204);
    }
}
