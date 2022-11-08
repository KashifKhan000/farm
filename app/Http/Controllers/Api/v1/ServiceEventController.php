<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ServiceEvent\{CompleteServiceEvent, IndexServiceEvent, ShowServiceEvent, StoreServiceEvent, UpdateServiceEvent, DestroyServiceEvent };
use App\Models\{ServiceEvent};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;
use App\Traits\Controllers\Api\v1\HasAssetFields;

use Illuminate\Support\Carbon;

class ServiceEventController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the service_events.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEvent\IndexServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexServiceEvent $request)
    {
        $fields = $request->validated();

        $user = auth()->user();
        $service_events = $user->service_events()->select();

        $fields['end_at'] = !empty($fields['end_at']) ? $fields['end_at'] : null;

        if (!empty($fields['start_at']) || !empty($fields['end_at'])) {
            $service_events = $service_events->where('status', '!=', 'Completed')->dateBetween($fields['start_at'], $fields['end_at']);
        }

        return $this->filtered($service_events, $fields, 'service_event', 'index');
    }

    /**
     * Display the specified service_event.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEvent\ShowServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceEvent $service_event, ShowServiceEvent $request)
    {
        return $this->loaded($service_event, 'service_event', 'show');
    }

    /**
     * Store a newly created service_event in storage.
     *
     * @param  \App\Http\Requests\Api\v1\ServiceEvent\StoreServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceEvent $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id()
        ]);

        if (!empty($fields['start_at'])) $fields['start_at'] = Carbon::parse($fields['start_at'])->toDateTimeString();
        if (!empty($fields['end_at'])) $fields['end_at'] = Carbon::parse($fields['end_at'])->toDateTimeString();

        $service_event = ServiceEvent::create($fields)->fresh();

        $this->attachAssets($service_event, $fields, 'equipment');
        $this->attachAssets($service_event, $fields, 'cylinder');

        return $this->loaded($service_event, 'service_event', 'store');
    }

    /**
     * Update the specified service_event in storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEvent\UpdateServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceEvent $service_event, UpdateServiceEvent $request)
    {
        $fields = $request->validated();

        if(!empty($fields['start_at'])) $fields['start_at'] = Carbon::parse($fields['start_at'])->toDateTimeString();
        if (!empty($fields['end_at'])) $fields['end_at'] = Carbon::parse($fields['end_at'])->toDateTimeString();

        $service_event->fill($fields);
        $service_event->save();

        $this->attachAssets($service_event, $fields, 'equipment');
        $this->attachAssets($service_event, $fields, 'cylinder');

        return $this->loaded($service_event, 'service_event', 'update');
    }

    /**
     * Remove the specified service_event from storage.
     *
     * @param  \App\Models\ServiceEvent  $service_event
     * @param  \App\Http\Requests\Api\v1\ServiceEvent\DestroyServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceEvent $service_event, DestroyServiceEvent $request)
    {
        $service_event->delete();
        return response()->json(null, 204);
    }
}
