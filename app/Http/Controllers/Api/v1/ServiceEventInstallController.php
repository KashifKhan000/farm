<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEventInstall\{ IndexServiceEventInstall, ShowServiceEventInstall, StoreServiceEventInstall, UpdateServiceEventInstall, DestroyServiceEventInstall };
use App\Models\{ServiceEvent, ServiceEventInstall};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;
use App\Traits\Controllers\Api\v1\HasAssetFields;

class ServiceEventInstallController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the service_event_installs.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventInstall\IndexServiceEventInstall  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceEvent $service_event, IndexServiceEventInstall $request)
    {
        $fields = $request->validated();
        $service_event_installs = ServiceEventInstall::select();

        return $this->filtered($service_event_installs, $fields);
    }

    /**
     * Display the specified service_event_install.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventInstall  $service_event_install
     * @param  \App\Http\Requests\Api\v1\ServiceEventInstall\ShowServiceEventInstall  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ServiceEventInstall $service_event_install, ShowServiceEventInstall $request)
    {
        return $service_event_install;
    }

    /**
     * Store a newly created service_event_install in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEventInstall\StoreServiceEventInstall  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceEvent $service_event, StoreServiceEventInstall $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id(),
            'service_event_id' => $service_event->id,
        ]);

        return ServiceEventInstall::create($fields)->fresh();
    }

    /**
     * Update the specified service_event_install in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventInstall  $service_event_install
     * @param  \App\Http\Requests\Api\v1\ServiceEventInstall\UpdateServiceEventInstall  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, ServiceEventInstall $service_event_install, UpdateServiceEventInstall $request)
    {
        $fields = $request->validated();

        $service_event_install->fill($fields);
        $service_event_install->save();

        return $service_event_install;
    }

    /**
     * Remove the specified service_event_install from storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Models\ServiceEventInstall  $service_event_install
     * @param  \App\Http\Requests\Api\v1\ServiceEventInstall\DestroyServiceEventInstall  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, ServiceEventInstall $service_event_install, DestroyServiceEventInstall $request)
    {
        $service_event_install->delete();
        return response()->json(null, 204);
    }
}
